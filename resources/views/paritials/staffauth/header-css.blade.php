
  
	<style>

body{
	font-family:Century Glothic;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 26px;
  position: absolute;
  top: 1px;
  right: 5px;
  width: 20px;
}
.select2-results__option {
  padding-right: 20px;
  vertical-align: middle;
}
.select2-container--default .select2-selection--single .select2-selection__clear {
  cursor: pointer;
  float: right;
  font-weight: bold;
  display: none;
}
.select2-results__option:before {
  content: "";
  display: inline-block;
  position: relative;
  height: 20px;
  width: 20px;
  border: 1px solid #e9e9e9;
  border-radius: 4px;
  background-color: #fff;
  margin-right: 20px;
  vertical-align: middle;
}
.select2-results__option[aria-selected=true]:before {
  font-family:Century Glothic;
  content: "\f00c";
  color: #fff;
  background-color: #f77750;
  border: 0;
  display: inline-block;
  padding-left: 3px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
	background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: #eaeaeb;
	color: #272727;
}
.select2-container--default .select2-selection--multiple {
	margin-bottom: 10px;
}
.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
	border-radius: 4px;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
	border-color: #f77750;
	border-width: 1px;
}
.select2-container--default .select2-selection--multiple {
	border-width: 1px;
}
.select2-container--open .select2-dropdown--below {
	
	border-radius: 6px;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.select2-selection .select2-selection--multiple:after {
	content: 'hhghgh';
}
/* select with icons badges single*/
.select-icon .select2-selection__placeholder .badge {
	display: none;
}
.select-icon .placeholder {
	display: none;
}
.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
	display: none !important;
	/* content: "" !important; */
}
.select-icon  .select2-search--dropdown {
	display: none;
}
.color
{
	width: 25px !important;
height: 25px !important;
border-radius: 50%;
border: none;
background-color: transparent;
}
.fcolor
{
	color:#808080;
}
.page-body .table
{
	color:#808080;
}
.modal-body
{
	color:#808080;
}

/* ── SweetAlert2 Modal Sizing & Styling Overrides ── */
.swal2-popup {
    font-size: 1.6rem !important;
    width: 500px !important;
    max-width: 90% !important;
}

/* Make form-select match form-control size and height */
.form-select {
    padding: .5rem 2.25rem .5rem .75rem !important;
    font-size: 1.5rem !important;
    line-height: 1.5 !important;
    height: auto !important;
}

/* ── Bootstrap Table Pagination Alignment: Rows per page (Left), < 1 2 3 > (Centre), Showing info (Right) ── */
.fixed-table-pagination {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: nowrap !important;
    width: 100% !important;
    margin-top: 15px !important;
    margin-bottom: 15px !important;
    position: relative !important;
    clear: both !important;
}
.fixed-table-pagination:before,
.fixed-table-pagination:after {
    display: none !important;
}
.fixed-table-pagination .pull-left,
.fixed-table-pagination .pull-right {
    float: none !important;
}
.fixed-table-pagination .pagination-detail {
    display: contents !important;
}
.fixed-table-pagination .page-list {
    order: 1 !important;
    flex: 1 1 0% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    text-align: left !important;
    margin: 0 !important;
    white-space: nowrap !important;
}
.fixed-table-pagination .page-list .btn-group {
    position: relative;
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px !important;
}
.fixed-table-pagination div.pagination {
    order: 2 !important;
    flex: 0 0 auto !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    margin: 0 auto !important;
    float: none !important;
}
.fixed-table-pagination div.pagination .pagination {
    margin: 0 !important;
    padding: 0 !important;
    display: inline-flex !important;
    justify-content: center !important;
    align-items: center !important;
    list-style: none !important;
    gap: 4px !important;
}
.fixed-table-pagination div.pagination .pagination > li {
    display: inline-block !important;
    margin: 0 !important;
}
.fixed-table-pagination .pagination a,
.fixed-table-pagination div.pagination .pagination > li > a {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 32px !important;
    height: 32px !important;
    padding: 0 10px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    line-height: 1 !important;
    color: #495057 !important;
    background-color: #ffffff !important;
    border: 1px solid #dee2e6 !important;
    border-radius: 6px !important;
    text-decoration: none !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
    transition: all 0.15s ease-in-out !important;
    user-select: none !important;
}
.fixed-table-pagination div.pagination .pagination > li:not(.active):not(.disabled) > a:hover {
    background-color: #f1f3f5 !important;
    border-color: #ced4da !important;
    color: #183543 !important;
}
/* ── Selected / Active Page Highlight ── */
.fixed-table-pagination div.pagination .pagination > li.active > a,
.fixed-table-pagination div.pagination .pagination > li.page-number.active > a,
.fixed-table-pagination div.pagination .pagination > li.active > a:hover,
.fixed-table-pagination div.pagination .pagination > li.active > a:focus {
    background-color: #183543 !important;
    border-color: #183543 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    cursor: default !important;
    box-shadow: 0 2px 6px rgba(24, 53, 67, 0.35) !important;
}
/* ── Disabled Buttons (< and > at bounds, ellipsis separators) ── */
.fixed-table-pagination div.pagination .pagination > li.disabled > a,
.fixed-table-pagination div.pagination .pagination > li.page-first-separator > a,
.fixed-table-pagination div.pagination .pagination > li.page-last-separator > a {
    color: #adb5bd !important;
    background-color: #f8f9fa !important;
    border-color: #e9ecef !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
    box-shadow: none !important;
    opacity: 0.65 !important;
}
/* ── Dark Mode Support ── */
body.dark .fixed-table-pagination div.pagination .pagination > li > a {
    background-color: #232b3e !important;
    border-color: #323c52 !important;
    color: #e0e6ed !important;
}
body.dark .fixed-table-pagination div.pagination .pagination > li:not(.active):not(.disabled) > a:hover {
    background-color: #2f3a53 !important;
    border-color: #424e6b !important;
    color: #ffffff !important;
}
body.dark .fixed-table-pagination div.pagination .pagination > li.active > a,
body.dark .fixed-table-pagination div.pagination .pagination > li.page-number.active > a {
    background-color: #183543 !important;
    border-color: #00baf2 !important;
    color: #ffffff !important;
    box-shadow: 0 0 8px rgba(0, 186, 242, 0.45) !important;
}
body.dark .fixed-table-pagination div.pagination .pagination > li.disabled > a,
body.dark .fixed-table-pagination div.pagination .pagination > li.page-first-separator > a,
body.dark .fixed-table-pagination div.pagination .pagination > li.page-last-separator > a {
    background-color: #1e2533 !important;
    border-color: #2a3346 !important;
    color: #616e85 !important;
}
.fixed-table-pagination .pagination-info {
    order: 3 !important;
    flex: 1 1 0% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    text-align: right !important;
    margin: 0 !important;
    white-space: nowrap !important;
    line-height: normal !important;
}
@media (max-width: 767.98px) {
    .fixed-table-pagination {
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 10px !important;
    }
    .fixed-table-pagination .page-list,
    .fixed-table-pagination div.pagination,
    .fixed-table-pagination .pagination-info {
        flex: 0 0 auto !important;
        width: 100% !important;
        justify-content: center !important;
        text-align: center !important;
    }
}

/* ── jQuery DataTables Pagination Selected Page Highlight ── */
div.dataTables_wrapper div.dataTables_paginate {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    gap: 4px !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination > li > a,
div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.paginate_button > a,
div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 32px !important;
    height: 32px !important;
    padding: 0 10px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    line-height: 1 !important;
    color: #495057 !important;
    background: #ffffff !important;
    border: 1px solid #dee2e6 !important;
    border-radius: 6px !important;
    text-decoration: none !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
    transition: all 0.15s ease-in-out !important;
    user-select: none !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination > li:not(.active):not(.disabled) > a:hover,
div.dataTables_wrapper div.dataTables_paginate .paginate_button:not(.current):not(.disabled):hover {
    background: #f1f3f5 !important;
    border-color: #ced4da !important;
    color: #183543 !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.active > a,
div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.active > a:hover,
div.dataTables_wrapper div.dataTables_paginate .paginate_button.current,
div.dataTables_wrapper div.dataTables_paginate .paginate_button.current:hover {
    background: #183543 !important;
    border-color: #183543 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    cursor: default !important;
    box-shadow: 0 2px 6px rgba(24, 53, 67, 0.35) !important;
}
div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.disabled > a,
div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled {
    color: #adb5bd !important;
    background: #f8f9fa !important;
    border-color: #e9ecef !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
    box-shadow: none !important;
    opacity: 0.65 !important;
}
    </style>
