<?php
header ("Content-Type:text/css");
$color = "#ea0117"; // Change your Color Here

function checkhexcolor($color) {
  return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
  $color = "#" . $_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
  $color = "#ea0117";
}

?>

.app-header,
.btn-primary,
.btn-primary:hover,
.app-search__button,
.material-half-bg .cover,
.dropdown-item:active,
.page-item.active .page-link,
.datepicker table tr td.active:active, .datepicker table tr td.active.highlighted:active, .datepicker table tr td.active.active, .datepicker table tr td.active.highlighted.active, .open > .dropdown-toggle.datepicker table tr td.active, .open > .dropdown-toggle.datepicker table tr td.active.highlighted
{
background-color: <?php echo $color; ?> !important;
}

.form-control:focus,
.btn-primary,
.btn-primary:hover,
.copy-code,
.page-item.active .page-link,
.datepicker table tr td.active:active, .datepicker table tr td.active.highlighted:active, .datepicker table tr td.active.active, .datepicker table tr td.active.highlighted.active, .open > .dropdown-toggle.datepicker table tr td.active, .open > .dropdown-toggle.datepicker table tr td.active.highlighted
{
border-color: <?php echo $color; ?> !important;
}

.toggle input[type="checkbox"]:checked + .button-indecator:before,
.comment-content .comment-author a:hover,
a,
a:hover,
.page-link
{
color: <?php echo $color; ?>;
}

.app-menu__item.active,
.app-menu__item:hover,
.app-menu__item:focus,
.treeview.is-expanded [data-toggle='treeview'],
.sidebar-mini.sidenav-toggled .treeview:hover .app-menu__item
{
border-left-color: <?php echo $color; ?>;
}