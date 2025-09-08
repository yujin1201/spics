var cellYm = function (row, columnfield, value, defaulthtml, columnproperties) {
  return '<div style="text-align:' + columnproperties.cellsalign + '; text-overflow: ellipsis; overflow: hidden; padding-bottom: 2px;margin-top: 5.5px;">' + (value).replace(/([0-9]{4})([0-9]{2})$/, "$1-$2") + '</div>'
}
var cellYmd = function (row, columnfield, value, defaulthtml, columnproperties) {
  return '<div style="text-align:' + columnproperties.cellsalign + '; text-overflow: ellipsis; overflow: hidden; padding-bottom: 2px;margin-top: 5.5px;">' + (value).replace(/([0-9]{4})([0-9]{2})([0-9]{2})$/, "$1-$2-$3") + '</div>'
}
var cellRowNum = function (row, columnfield, value, defaulthtml, columnproperties) {
  return '<div style="text-align:' + columnproperties.cellsalign + '; text-overflow: ellipsis; overflow: hidden; padding-bottom: 2px;margin-top: 5.5px;">' +( value +1)+ '</div>'
}
var aggSum = function (aggregates) {
  var renderstring = "";
  $.each(aggregates, function (key, value) {
    renderstring += '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center;">' + value + '</div>';
  });
  return renderstring;
} ;

var aggCount =function (aggregates) {
  var renderstring = "";
  $.each(aggregates, function (key, value) {
    renderstring  = value ;
  });
  return renderstring;
} ;


