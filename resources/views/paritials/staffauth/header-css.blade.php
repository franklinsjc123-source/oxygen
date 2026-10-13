
  
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
    display: inline-flex !important;
    justify-content: center !important;
    align-items: center !important;
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
    </style>
