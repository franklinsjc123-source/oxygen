<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Master\Colors\ProductColor;
use App\Models\Master\GST\GST;
use App\Models\Offer\Offer;

class ProductTemplateExport implements FromArray, WithHeadings, WithEvents, WithStyles, WithColumnWidths
{
    /**
     * Clean strings to form valid Excel named range identifiers.
     */
    public static function cleanRangeName($string): string
    {
        $string = str_replace(' & ', '_', $string);
        $string = str_replace('&', '_', $string);
        $string = str_replace(' ', '_', $string);
        $string = str_replace('/', '_', $string);
        $string = str_replace('-', '_', $string);
        $string = preg_replace('/_+/', '_', $string);
        return trim($string, '_');
    }

    /**
     * Column headers matching ImportProduct expected columns (Row 1)
     */
    public function headings(): array
    {
        return [
            'Product Name *',
            'HSN Code',
            'Main Category *',
            'Category *',
            'Sub Category *',
            'Description',
            'Weight (kg)',
            'Is Color Available',
            'Color',
            'Size',
            'Quantity *',
            'Retail Price (MRP) *',
            'Selling Price *',
            'SKU',
            'Return/Replace',
            'Return Days',
            'Low Stock Limit',
            'GST',
            'Offer',
            'Status'
        ];
    }

    /**
     * Sample product rows to guide the user (Data starts at Row 2)
     */
    public function array(): array
    {
        $color = ProductColor::where('status', 1)->value('color_name') ?? 'Red';
        $gst = GST::where('status', 1)->value('gst_name') ?? 'GST 5%';
        $offer = Offer::where('status', 1)->value('title') ?? '';

        return [
            [
                'Men Slim Fit Cotton Casual Shirt',
                '6205',
                'Men',
                'Topwear',
                'Casual Shirt',
                'Premium 100% combed cotton casual shirt for everyday comfort.',
                '0.35',
                'Yes',
                $color,
                'M',
                50,
                1499,
                799,
                'SHIRT-COT-M-001',
                'return',
                7,
                5,
                $gst,
                $offer,
                'Active'
            ],
            [
                'Kids Printed Round Neck Cotton T-Shirt',
                '6205',
                'Kids',
                'Boys',
                'T-Shirts',
                'Comfortable soft cotton regular fit daily wear t-shirt.',
                '0.20',
                'No',
                'NA',
                'L',
                40,
                899,
                499,
                'KIDS-TSHIRT-L-001',
                'return',
                7,
                5,
                $gst,
                $offer,
                'Active'
            ]
        ];
    }

    /**
     * Column Widths for a clean presentation
     */
    public function columnWidths(): array
    {
        return [
            'A' => 32, // Product Name
            'B' => 14, // HSN Code
            'C' => 20, // Main Category
            'D' => 22, // Category
            'E' => 24, // Sub Category
            'F' => 35, // Description
            'G' => 14, // Weight
            'H' => 18, // Is Color Available
            'I' => 16, // Color
            'J' => 12, // Size
            'K' => 14, // Quantity
            'L' => 20, // Retail Price
            'M' => 18, // Selling Price
            'N' => 20, // SKU
            'O' => 16, // Return/Replace
            'P' => 14, // Return Days
            'Q' => 16, // Low Stock Limit
            'R' => 16, // GST
            'S' => 22, // Offer
            'T' => 14, // Status
        ];
    }

    /**
     * Header row styling
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '183543']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ],
            'A:T' => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ]
        ];
    }

    /**
     * Setup cascading dependent dropdowns:
     * Main Category (Column C) -> Category (Column D) -> Sub Category (Column E)
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $spreadsheet = $sheet->getParent();

                // Freeze header row
                $sheet->freezePane('A2');
                $sheet->getRowDimension(1)->setRowHeight(28);

                // Create hidden 'lists' worksheet
                $listSheet = $spreadsheet->createSheet();
                $listSheet->setTitle('lists');

                $colIndex = 1;

                // 1. Column 1 (lists!A): Main Categories List
                $mainCategories = CategoryMain::where('status', 1)->get();
                $mainCatNames = [];
                foreach ($mainCategories as $r => $m) {
                    $mName = trim($m->category_main_name);
                    $mainCatNames[] = $mName;
                    $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $mName);
                }
                $mainColLetter = Coordinate::stringFromColumnIndex($colIndex);
                $mainCatFormula = '=lists!$' . $mainColLetter . '$1:$' . $mainColLetter . '$' . max(count($mainCatNames), 1);
                $colIndex++;

                // 2. Named ranges for Category dependent on Main Category
                foreach ($mainCategories as $m) {
                    $mClean = self::cleanRangeName($m->category_main_name);
                    $cats = Category::where('main_category_id', $m->id)
                        ->where('status', 1)
                        ->pluck('category_name')
                        ->filter()
                        ->unique()
                        ->values()
                        ->toArray();

                    if (!empty($cats)) {
                        foreach ($cats as $r => $cName) {
                            $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $cName);
                        }
                        $colLetter = Coordinate::stringFromColumnIndex($colIndex);
                        $rangeStr = '$' . $colLetter . '$1:$' . $colLetter . '$' . count($cats);
                        $spreadsheet->addNamedRange(new NamedRange($mClean, $listSheet, $rangeStr));
                        $colIndex++;
                    }
                }

                // 3. Named ranges for Sub Category dependent on Main Category + Category
                foreach ($mainCategories as $m) {
                    $mClean = self::cleanRangeName($m->category_main_name);
                    $cats = Category::where('main_category_id', $m->id)
                        ->where('status', 1)
                        ->get();

                    foreach ($cats as $c) {
                        $cClean = self::cleanRangeName($c->category_name);
                        $rangeName = $mClean . '_' . $cClean;

                        $subs = CategorySub::where('category_id', $c->id)
                            ->where('status', 1)
                            ->pluck('category_sub_name')
                            ->filter()
                            ->unique()
                            ->values()
                            ->toArray();

                        // Fallback to '-' if category has no subcategory yet
                        if (empty($subs)) {
                            $subs = ['-'];
                        }

                        foreach ($subs as $r => $subName) {
                            $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $subName);
                        }
                        $colLetter = Coordinate::stringFromColumnIndex($colIndex);
                        $rangeStr = '$' . $colLetter . '$1:$' . $colLetter . '$' . count($subs);
                        $spreadsheet->addNamedRange(new NamedRange($rangeName, $listSheet, $rangeStr));
                        $colIndex++;
                    }
                }

                // 4. Other static lists (Colors, GST, Offers, Options)
                $colors = ProductColor::where('status', 1)->pluck('color_name')->filter()->unique()->values()->toArray();
                $colLetterColors = Coordinate::stringFromColumnIndex($colIndex);
                foreach ($colors as $r => $v) { $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $v); }
                $rangeStrColors = '$' . $colLetterColors . '$1:$' . $colLetterColors . '$' . count($colors);
                $spreadsheet->addNamedRange(new NamedRange('Colors_List', $listSheet, $rangeStrColors));
                $colIndex++;

                // NA list for when Is Color Available is No
                $colLetterNoColor = Coordinate::stringFromColumnIndex($colIndex);
                $listSheet->setCellValueByColumnAndRow($colIndex, 1, 'NA');
                $spreadsheet->addNamedRange(new NamedRange('Colors_None', $listSheet, '$' . $colLetterNoColor . '$1:$' . $colLetterNoColor . '$1'));
                $colIndex++;

                $gsts = GST::where('status', 1)->pluck('gst_name')->filter()->unique()->values()->toArray();
                $colLetterGST = Coordinate::stringFromColumnIndex($colIndex);
                foreach ($gsts as $r => $v) { $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $v); }
                $gstFormula = count($gsts) > 0 ? '=lists!$' . $colLetterGST . '$1:$' . $colLetterGST . '$' . count($gsts) : '""';
                $colIndex++;

                $offers = Offer::where('status', 1)->pluck('title')->filter()->unique()->values()->toArray();
                $colLetterOffers = Coordinate::stringFromColumnIndex($colIndex);
                foreach ($offers as $r => $v) { $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $v); }
                $offerFormula = count($offers) > 0 ? '=lists!$' . $colLetterOffers . '$1:$' . $colLetterOffers . '$' . count($offers) : '""';
                $colIndex++;

                $returnOptions = ['none', 'return', 'replace'];
                $colLetterReturn = Coordinate::stringFromColumnIndex($colIndex);
                foreach ($returnOptions as $r => $v) { $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $v); }
                $returnFormula = '=lists!$' . $colLetterReturn . '$1:$' . $colLetterReturn . '$' . count($returnOptions);
                $colIndex++;

                $colorOptions = ['Yes', 'No'];
                $colLetterIsColor = Coordinate::stringFromColumnIndex($colIndex);
                foreach ($colorOptions as $r => $v) { $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $v); }
                $isColorFormula = '=lists!$' . $colLetterIsColor . '$1:$' . $colLetterIsColor . '$' . count($colorOptions);
                $colIndex++;

                $statusOptions = ['Active', 'Inactive'];
                $colLetterStatus = Coordinate::stringFromColumnIndex($colIndex);
                foreach ($statusOptions as $r => $v) { $listSheet->setCellValueByColumnAndRow($colIndex, $r + 1, $v); }
                $statusFormula = '=lists!$' . $colLetterStatus . '$1:$' . $colLetterStatus . '$' . count($statusOptions);
                $colIndex++;

                // Hide the lists reference sheet
                $listSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

                // 5. Apply Data Validations for rows 2 to 500
                for ($row = 2; $row <= 500; $row++) {
                    // Column C: Main Category
                    $vC = $sheet->getCell("C{$row}")->getDataValidation();
                    $vC->setType(DataValidation::TYPE_LIST)
                        ->setAllowBlank(false)
                        ->setShowDropDown(true)
                        ->setFormula1($mainCatFormula);

                    // Column D: Category (Dependent on Main Category in Column C)
                    // Excel / LibreOffice formula: =INDIRECT(clean(C{row}))
                    $cleanC = 'SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(C' . $row . '," & ","_")," ","_"),"/","_")';
                    $vD = $sheet->getCell("D{$row}")->getDataValidation();
                    $vD->setType(DataValidation::TYPE_LIST)
                        ->setAllowBlank(true)
                        ->setShowDropDown(true)
                        ->setErrorStyle(DataValidation::STYLE_STOP)
                        ->setShowErrorMessage(true)
                        ->setErrorTitle('Invalid Category')
                        ->setError('Please select a valid Category for the selected Main Category.')
                        ->setFormula1('=INDIRECT(' . $cleanC . ')');

                    // Column E: Sub Category (Dependent on Main Category C{row} and Category D{row})
                    // Excel / LibreOffice formula: =INDIRECT(clean(C{row}) & "_" & clean(D{row}))
                    $cleanD = 'SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(D' . $row . '," & ","_")," ","_"),"/","_")';
                    $vE = $sheet->getCell("E{$row}")->getDataValidation();
                    $vE->setType(DataValidation::TYPE_LIST)
                        ->setAllowBlank(true)
                        ->setShowDropDown(true)
                        ->setErrorStyle(DataValidation::STYLE_STOP)
                        ->setShowErrorMessage(true)
                        ->setErrorTitle('Invalid Sub Category')
                        ->setError('Please select a valid Sub Category for the selected Category.')
                        ->setFormula1('=INDIRECT(' . $cleanC . '&"_"&' . $cleanD . ')');

                    // Column H: Is Color Available (Yes/No)
                    $vH = $sheet->getCell("H{$row}")->getDataValidation();
                    $vH->setType(DataValidation::TYPE_LIST)->setAllowBlank(true)->setShowDropDown(true)->setFormula1($isColorFormula);

                    // Column I: Color (Dependent on Column H: Is Color Available)
                    $vI = $sheet->getCell("I{$row}")->getDataValidation();
                    $vI->setType(DataValidation::TYPE_LIST)
                        ->setAllowBlank(true)
                        ->setShowDropDown(true)
                        ->setErrorStyle(DataValidation::STYLE_STOP)
                        ->setShowErrorMessage(true)
                        ->setErrorTitle('Color Not Allowed')
                        ->setError('Color selection is only allowed when "Is Color Available" is set to Yes.')
                        ->setFormula1('=INDIRECT(IF(H' . $row . '="Yes","Colors_List","Colors_None"))');

                    // Column O: Return/Replace (none, return, replace)
                    $vO = $sheet->getCell("O{$row}")->getDataValidation();
                    $vO->setType(DataValidation::TYPE_LIST)->setAllowBlank(true)->setShowDropDown(true)->setFormula1($returnFormula);

                    // Column R: GST
                    if (count($gsts) > 0) {
                        $vR = $sheet->getCell("R{$row}")->getDataValidation();
                        $vR->setType(DataValidation::TYPE_LIST)->setAllowBlank(true)->setShowDropDown(true)->setFormula1($gstFormula);
                    }

                    // Column S: Offer
                    if (count($offers) > 0) {
                        $vS = $sheet->getCell("S{$row}")->getDataValidation();
                        $vS->setType(DataValidation::TYPE_LIST)->setAllowBlank(true)->setShowDropDown(true)->setFormula1($offerFormula);
                    }

                    // Column T: Status (Active, Inactive)
                    $vT = $sheet->getCell("T{$row}")->getDataValidation();
                    $vT->setType(DataValidation::TYPE_LIST)->setAllowBlank(false)->setShowDropDown(true)->setFormula1($statusFormula);
                }

                // 6. Conditional Formatting: Highlight in red if values do not match parent dependencies
                $condD = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
                $condD->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_EXPRESSION);
                $condD->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_NONE);
                $condD->addCondition('AND(C2<>"", D2<>"", ISERROR(MATCH(D2, INDIRECT(SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(C2," & ","_")," ","_"),"/","_")), 0)))');
                $condD->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getEndColor()->setARGB('FFFFC7CE');
                $condD->getStyle()->getFont()->getColor()->setARGB('FF9C0006');
                $condD->getStyle()->getFont()->setBold(true);
                $sheet->setConditionalStyles('D2:D500', [$condD]);

                $condE = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
                $condE->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_EXPRESSION);
                $condE->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_NONE);
                $condE->addCondition('AND(C2<>"", D2<>"", E2<>"", ISERROR(MATCH(E2, INDIRECT(SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(C2," & ","_")," ","_"),"/","_")&"_"&SUBSTITUTE(SUBSTITUTE(SUBSTITUTE(D2," & ","_")," ","_"),"/","_")), 0)))');
                $condE->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getEndColor()->setARGB('FFFFC7CE');
                $condE->getStyle()->getFont()->getColor()->setARGB('FF9C0006');
                $condE->getStyle()->getFont()->setBold(true);
                $sheet->setConditionalStyles('E2:E500', [$condE]);

                $condI = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
                $condI->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_EXPRESSION);
                $condI->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_NONE);
                $condI->addCondition('AND(H2="No", I2<>"", I2<>"NA")');
                $condI->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getEndColor()->setARGB('FFFFC7CE');
                $condI->getStyle()->getFont()->getColor()->setARGB('FF9C0006');
                $condI->getStyle()->getFont()->setBold(true);
                $sheet->setConditionalStyles('I2:I500', [$condI]);
            }
        ];
    }
}
