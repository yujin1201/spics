/*******************************************************
 ㅡ문자열 관련
 ********************************************************/

//초과 문자열 삭제.
function cutMsg(str, max){
    var ret='';
    var i;
    var msglen=0;

    for(i=0;i<str.length;i++){
        var ch=str.charAt(i);
        if(escape(ch).length >4){
            msglen += 2;
        }else{
            msglen++;
        }
        if(msglen > max) break;
        ret += ch;
    }
    return ret;
}

//문자열 COUNT
function reCount(str){
    var i;
    var msglen=0;

    for(i=0;i<str.length;i++){
        var ch=str.charAt(i);
        if(escape(ch).length >4){
            msglen += 2;
        }else{
            msglen++;
        }
    }
    return msglen;
}

//글자수 제한 (한글 2Byte, 그외 1Byte)
function byteCheck(obj,max){
    var msglen=0;
    msglen = reCount(obj.value);
    if(msglen > max){
        rem = msglen - max;
        alert('입력하신 문장의 총길이는 ' + msglen + '입니다.\n초과되는 ' + rem + '바이트는 삭제됩니다.');
        obj.value = cutMsg(obj.value,max);
    }
}

function byteCheckNum(obj,max){
    var msglen=0;
    msglen = reCount(obj.value);
    if(msglen > max){
        rem = msglen - max;
        alert(max + '자리까지 입력하실수 있습니다.');
        obj.value = cutMsg(obj.value,max);
    }
}
//문자열의 byte 수
function getByteLength( str ){
    var len = 0;
    if( null == str ) return 0;
    for( index = 0 ; index < str.length ; index++, len++ )
    {
        if( escape( str.substring( index, index + 1 ) ).length == 6 ) len++;
    }
    return len;
}

//문자열의 byte수가 주어진 크기 초과여부
function checkByteLength( obj, size  ){
    if (obj!=null) {
        if (getByteLength(obj.value)>size) {
            alert(size+" byte 이내로 입력하세요.)") ;
            obj.value = "";
            obj.focus();
        }
    }
}

//좌우 공백제거
function trim(str) {
    if (str == ''){
        return '';
    }
    var count = str.length;
    var len = count;
    var st = 0;

    while ((st < len) && (str.charAt(st) <= ' ')) {
        st++;
    }
    while ((st < len) && (str.charAt(len - 1) <= ' ')) {
        len--;
    }
    return ((st > 0) || (len < count)) ? str.substring(st, len) : str ;
}

//replace
function replace(str, original, replacement){
    var result = '';
    if (str == undefined || str == null){
        return result;
    }
    while(str.indexOf(original) != -1){
        if (str.indexOf(original) > 0)
            result = result + str.substring(0, str.indexOf(original)) + replacement;
        else
            result = result + replacement;
        str = str.substring(str.indexOf(original) + original.length, str.length);
    }
    return result + str;
}

//문자 왼쪽에 패딩
function leftPad(src, pad, len){

    if (src == null) src = '';

    while (src.length < len){
        src = pad + src;
    }
    return src;
}

//문자 오른쪽 패딩
function rightPad(src, pad, len){

    if (src == null) src = '';

    while (src.length < len){
        src = src + pad;
    }
    return src;
}

/**
 * 최대값 체크 후 메시지
 */
function maxByte(msg,size,obj){

    var getlength = bytes(obj.value) / 2;


    if(getlength > size){
        alert(msg+" 은(는) 한글 "+size+"자를 초과 할수 없습니다.");
        return false;
    }
    return true;
}
/**
 * 바이트를 구한다..
 */
function bytes(str) {
    var len = 0;
    str = this != window ? this : str;
    for (j = 0; j < str.length; j++) {
        var chr = str.charAt(j);
        len += (chr.charCodeAt() > 128) ? 2 : 1;
    }
    return len;
}

function getCheckedValue(radioObj) {
    if(!radioObj)
        return "";
    var radioLength = radioObj.length;
    if(radioLength == undefined)
        if(radioObj.checked)
            return radioObj.value;
        else
            return "";
    for(var i = 0; i < radioLength; i++) {
        if(radioObj[i].checked) {
            return radioObj[i].value;
        }
    }
    return "";
}

//사업자번호,주민번호 포맷
function formatBizNo(bizNo){
    var rtnvalue = '';
    bizNo = bizNo.replace("-","");
    if (bizNo != 'undefined' && bizNo != 'null'){
        if (bizNo.length == 10){
            rtnvalue = bizNo.substr(0,3)+'-'+bizNo.substr(3,2)+'-'+bizNo.substr(5,5);
        }else if(bizNo.length == 13){
            rtnvalue = bizNo.substr(0,6)+'-'+bizNo.substr(7,7);
        }else{
            rtnvalue = bizNo;
        }
    }
    return rtnvalue;
}
//우편번호 포맷
function formatZip(zip){
    var rtnvalue = '';
    if (zip != 'undefined' && zip != 'null' && zip != null){
        if (zip.length == 6){
            rtnvalue = zip.substr(0,3)+'-'+zip.substr(3,3);
        }else{
            rtnvalue = zip;
        }
    }
    return rtnvalue;
}
//전화번호 유효성체크 ..
function chktel(telnumber){
    telnumber = telnumber.replaceAll("-", "");

    localNum = new Array("02","031","032","033","041","042","043","051","052","053","054","055","061","062","063","064","012","015","010","011","016","017","018","019","0502","070");
    tel1 = "";
    for (ia=0; ia<localNum.length; ia++)  // 앞에 세 자리 가운데 지역번호 유효성 검사
    {
        if (telnumber.substr(0,3) == localNum[ia])
        {
            tel1 = telnumber.substr(0,3);
            tel2 = telnumber.substr(3,telnumber.length);
            break;
        }
    }
    if (tel1 == "")
        for (ia=0; ia<localNum.length; ia++)   // 앞에 두 자리 가운데 지역번호 유효성 검사
        {
            if (telnumber.substr(0,2) == localNum[ia])
            {
                tel1 = telnumber.substr(0,2);
                tel2 = telnumber.substr(2,telnumber.length);
                break;
            }
        }
    if (tel1 == "")
        for (ia=0; ia<localNum.length; ia++)    // 앞에 네 자리 가운데 지역번호 유효성 검사
        {
            if (telnumber.substr(0,4) == localNum[ia])
            {
                tel1 = telnumber.substr(0,4);
                tel2 = telnumber.substr(4,telnumber.length);
                break;
            }
        }
    if (tel1 == "" || tel2.length > 8)  // 앞에 2,3,4 자리 가운데 지역번호가 없으면 잘못된 번호
    {
        return "false";
    }
    tel3 = tel2.substr(tel2.length-4,4);
    tel2 = tel2.substr(0,tel2.length-4);

    resultTel = tel1 + tel2 + tel3;

    return resultTel;
}

// email 형식 체크
function chkEmail(strValue){
    var regExp = /[0-9a-zA-Z][_0-9a-zA-Z-]*@[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+){1,2}$/;
    //입력을 안했다면
    if(strValue.lenght == 0){
        return false;
    }
    //데이터 형식이 맞지 않다면
    if (!strValue.match(regExp)){
        return false;
    }
    return true;
}

/**
 * @메세지 줄바꿈 관련. 2009.12.28
 * @return
 */
function enterReplace(value){
    value = value.replace(/^\s+/, "");  // 왼쪽 공백 제거
    value = value.replace(/\s+$/g, "");  //오른쪽 공백 제거
    value = value.replace(/\n/g, "");  //행바꿈제거
    value = value.replace(/\r/g, "\n");  //엔터제거
    return value;
}

/*********************************************
 숫자 관련
 **********************************************/
// 숫자 최대값 확인
function checkMax(what, max){
    var invalue = parseFloat(replace(what.value,',',''));
    if (max < invalue){
        alert('최대 '+max+' 값을 초과할 수 없습니다.');
        what.focus();
    }
}

// 숫자 자동 콤마처리
// 예 : <input type="text" size=20 OnKeyUp="comma(this)" style="text-align:right">
function comma(what){
    if (event.keyCode == 9){
        return;
    }
    var inData = what.value;
    var data = deleteIsNotValidateChar(inData);
    what.value = data;
}

function deleteIsNotValidateChar(data){
    var newData = '';
    var validateChar = '0123456789-.';
    for (var i=0; i < data.length; i++){
        if(validateChar.indexOf(data.charAt(i))!=-1){
            if ( (data.charAt(i)=='-' && i > 0 ) ||
                (data.charAt(i)=='.' && (i == 0 || i < data.lastIndexOf('.')) ) ||
                (data.charAt(i)=='.' && ( data.charAt(i-1)=='-' ||
                    validateChar.indexOf(data.charAt(i-1))==-1 ) )
                || (data.charAt(i)=='0' && (data.charAt(i-1)=='-'))
            ){
                //skip
            }else{
                newData += data.charAt(i);
            }
        }
    }
    if(newData != '' && newData != '-'){
        return addComma(newData);
    }else{
        return newData;
    }
}

function addComma(data){
    var startIdx = 0;
    var strConstant = '';
    var strDecimal = '';

    if (data.charAt(0)=='-'){
        startIdx = 1;
    }
    if (data.indexOf('.')!=-1){
        strConstant = data.substring(startIdx,data.indexOf('.'));
        strDecimal = data.substring(data.indexOf('.'));
    }else{
        strConstant = data.substring(startIdx);
    }

    var output = '';
    if (strConstant.length > 3){
        var mod = strConstant.length % 3;
        output = (mod > 0 ? (strConstant.substring(0,mod)) : '');

        for (var i=0; i<Math.floor(strConstant.length/3); i++){
            if ((mod == 0) && (i == 0))
                output += strConstant.substring(mod+3*i, mod+3*i+3);
            else
                output += ',' + strConstant.substring(mod+3*i, mod+3*i+3);
        }
    }
    var result = '';
    if (output!=''){
        result = output;
    }else{
        result = strConstant;
    }
    if (startIdx==1){
        result = '-' + result;
    }
    if (strDecimal!=''){
        result = result + strDecimal;
    }

    return(result);
}

//숫자만 입력
function onlyNumber(obj){
    var data = obj.value;
    var newData = '';
    var validateChar = '0123456789-.';
    for (var i=0; i < data.length; i++){
        if(validateChar.indexOf(data.charAt(i))!=-1){
            if ( (data.charAt(i)=='-' && i > 0 ) ||
                (data.charAt(i)=='.' && (i == 0 || i < data.lastIndexOf('.')) ) ||
                (data.charAt(i)=='.' && ( data.charAt(i-1)=='-' ||
                    validateChar.indexOf(data.charAt(i-1))==-1 ) )
                || (data.charAt(i)=='0' && (data.charAt(i-1)=='-'))
            ){
                //skip
            }else{
                newData += data.charAt(i);
            }
        }
    }
    obj.value = newData;
    return;
}

//통화 한글로 표시
function getKorCurrency(srcNumber){
    srcNumber = replace(srcNumber,',','');
    var rtn = '';
    if(srcNumber != ""){
        var i, j=0, k=0;
        var han1 = new Array("","일","이","삼","사","오","육","칠","팔","구");
        var han2 = new Array("","만 ","억 ","조 ","경 ","해 ","시 ","양 ","구 ","간 ");
        var han3 = new Array("","십","백","천");
        var result="", hangul = srcNumber + "", pm = "";
        var str = new Array(), str2="";
        var strTmp = new Array();

        if(parseInt(srcNumber)==0){
            rtn = "영"; //입력된 숫자가 0일 경우 처리
        }
        if(hangul.substring(0,1) == "-"){ //음수 처리
            pm = "마이너스 ";
            hangul = hangul.substring(1, hangul.length);
        }
        if(hangul.length > han2.length*4){
            rtn = "too much number";//범위를 넘는 숫자 처리 자리수 배열 han2에 자리수 단위만 추가하면 범위가 늘어남.
        }

        for(i=hangul.length; i > 0; i=i-4){
            str[j] = hangul.substring(i-4,i); //4자리씩 끊는다.
            for(k=str[j].length;k>0;k--){
                strTmp[k] = (str[j].substring(k-1,k))?str[j].substring(k-1,k):"";
                strTmp[k] = han1[parseInt(strTmp[k])];
                if(strTmp[k]) {
                    strTmp[k] += han3[str[j].length-k];
                }
                str2 = strTmp[k] + str2;
            }
            str[j] = str2;
            if(str[j]){
                result = str[j]+han2[j]+result;
            }
            //4자리마다 한칸씩 띄워서 보여주는 부분. 우선은 주석처리
            //result = (str[j])? " "+str[j]+han2[j]+result : " " + result;
            j++;
            str2 = "";
        }
        rtn = pm + result; //부호 + 숫자값
    }else{
        rtn = "";
    }
    return replace(rtn,' ','');
}

function checkNumber(data){
    var validateChar = '0123456789';
    for (var i=0; i < data.length; i++){
        if(validateChar.indexOf(data.charAt(i)) == -1){
            return true;
        }
    }
    return false;
}

function func_isNumeric(obj) {
    var code = window.event.keyCode;
    //alert(code);

    if(code == 190){
        alert("숫자만 입력 가능 합니다!");
        window.event.returnValue = false;
        return false;
    }

    if (code >= 48 && code <= 57){
        window.event.returnValue = true;
        return true;
    } else {
        alert("숫자만 입력 가능 합니다!");
        window.event.returnValue = false;
        return false;
    }
}

/**
 * @숫자만 입력하게함..
 * @return
 */
function num_only(Ev){
    var evCode =(window.netscape)?Ev.which:event.keyCode;
    if (!(evCode == 0 || evCode == 8 || evCode == 9 || ( evCode > 47 && evCode < 58 ))) {
        if (window.netscape){        // FF일 경우
            Ev.preventDefault() ;       // 이벤트 무효화
        }else{                        // IE일 경우
            event.returnValue=false;    // 이벤트 무효화
        }
    }
}

/*************************************************
 날짜 관련
 **************************************************/
var dateFormatSplit = '-';

//YYYYMMDD 문자열의 날짜 형식체크
function isValidDate(date){
    if (!date || date == '') return false;
    if (date.length != 8 || isNaN(date)) return false;
    var intYear  = parseInt(date.substr(0,4), 10);
    var intMonth = parseInt(date.substr(4,2), 10);
    var intDay   = parseInt(date.substr(6,2), 10);

    //alert(intYear + ':' + intMonth + ":" + intDay);

    if (intMonth < 1 || intMonth > 12) return false;

    if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) && (intDay > 31 || intDay < 1)) {
        return false;
    }
    if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) && (intDay > 30 || intDay < 1)) {
        return false;
    }
    if (intMonth == 2) {
        if (intDay < 1) {
            return false;
        }
        if (LeapYear(intYear) == true) {
            if (intDay > 29) {
                return false;
            }
        } else {
            if (intDay > 28) {
                return false;
            }
        }
    }
    return true;
}

//윤년
function LeapYear(intYear) {
    if (intYear % 100 == 0) {
        if (intYear % 400 == 0) { return true; }
    } else {
        if ((intYear % 4) == 0) { return true; }
    }
    return false;
}

//날짜 간의 차이일수
function dayDiffer(date1, date2){
    var differTime = date1.getTime() - date2.getTime();
    var differDay = Math.floor(differTime/(24*3600*1000));

    return differDay;
}
//yyyymmdd 일자와 오늘일자와의 차이일수
//오늘일자 - yyyymmdd
function dayDifferToday(yyyymmdd){
    return dayDiffer(getDate(getToday()), getDate(yyyymmdd));
}
//YYYYMMDD 문자열로 date 객체 구함
function getDate(str){
    if (isNaN(str) || str.length != 8){
        alert('getDate(str) Fungtion Error!\r\nYYYYMMDD 형식.');
        return false;
    }
    var d = new Date(str.substr(0,4), str.substr(4,2)-1, str.substr(6,2), 0,0,0,0);
    return d;
}

//YYYYMMDD 포맷의 오날 날짜
function getToday(){
    var date = new Date();
    var yyyy = date.getYear();
    var mm = date.getMonth()+1;
    var dd = date.getDate();

    if (mm < 10)
        mm = "0" + mm;
    if (dd < 10)
        dd = "0" + dd;

    return yyyy + "" + mm + "" + dd;
}
//YYYYMMDD 포맷의 오날 날짜
function getTodayFullYear(){
    var date = new Date();
    var yyyy = date.getFullYear();
    var mm = date.getMonth()+1;
    var dd = date.getDate();

    if (mm < 10)
        mm = "0" + mm;
    if (dd < 10)
        dd = "0" + dd;

    return yyyy + "" + mm + "" + dd;
}

//YYYYMMDDHH 포맷의 오날 날짜
function getTodayHour(){
    var date = new Date();
    var yyyy = date.getYear();
    var mm = date.getMonth()+1;
    var dd = date.getDate();
    var HH = date.getHours();

    if (mm < 10)
        mm = "0" + mm;
    if (dd < 10)
        dd = "0" + dd;

    return yyyy + "" + mm + "" + dd + "" + HH;
}

//YYYY-MM-DD 포맷의 오날 날짜
function getTodayWithDash(){
    var date = new Date();
    var yyyy = date.getYear();
    var mm = date.getMonth()+1;
    var dd = date.getDate();

    if (mm < 10)
        mm = "0" + mm;
    if (dd < 10)
        dd = "0" + dd;

    return yyyy + "-" + mm + "-" + dd;
}

/*
 * 날짜 일 연산(날짜 문자열, 추가할 일수, 날짜 구분자)
 */
function getAddDate(dateStr, addDay, split) {
    if(split == null) split = dateFormatSplit;
    dateStr = dateStr.replaceAll(split, "");

    var yyyy = dateStr.substring(0,4);
    var mm = parseInt(dateStr.substring(4,6), 10);
    var dd = parseInt(dateStr.substring(6), 10);

    var date = new Date(yyyy, mm-1, dd);
    date.setDate(date.getDate() + addDay);
    yyyy = date.getFullYear();
    mm = date.getMonth()+1;
    dd = date.getDate();

    if (mm < 10)
        mm = "0" + mm;
    if (dd < 10)
        dd = "0" + dd;

    return yyyy + split + mm + split + dd;
}

/**
 * 검색기간 validate check yyyy.MM.dd
 * @param fromDateObj 시작일 개체
 * @param toDateObj 종료일 개체
 * @return
 */
function validateSearchDate($fromDateObj, $toDateObj, name){
    var disName = (name == null || '') ? "검색" : name;

    if ($fromDateObj.val() == ''){
        alert(disName + ' 시작일을 입력하세요.');
        $fromDateObj.focus();
        return false;
    }
    if ($toDateObj.val() == ''){
        alert(disName + ' 종료일을 입력하세요.');
        $toDateObj.focus();
        return false;
    }
    var fromDate = replace(trim($fromDateObj.val()),'-','');
    var toDate = replace(trim($toDateObj.val()),'-','');

    if (!isValidDate(fromDate)){
        alert(disName + ' 시작일이 형식에 맞지 않습니다.');
        $fromDateObj.focus();
        return false;
    }
    if (!isValidDate(toDate)){
        alert(disName + ' 종료일이 형식에 맞지 않습니다.');
        $toDateObj.focus();
        return false;
    }

    if (dayDiffer(getDate(fromDate), getDate(toDate)) > 0 ){
        alert(disName + ' 시작일은 종료일 이전이어야 합니다.');
        $fromDateObj.focus();
        return false;
    }
    return true;
}

/**
 * @날짜형식으로 포멧을 바꿔줌. yyyy.MM.dd, yyyy-MM-dd
 * @return
 */
function formatDate(Ev, obj){
    var evCode =(window.netscape)?Ev.which:event.keyCode;
    if (evCode == 9){
        return;
    }
    var date = replace(obj.value,dateFormatSplit,'');
    if(date.length == 8){
        var d =  date.substring(0,4)+dateFormatSplit+date.substring(4,6)+dateFormatSplit+date.substring(6,8);
        obj.value = d;
        obj.focus();
    }
}
/**
 * 날짜형태 문자열의 포맷 YYYY-MM-DD
 * @param str 입력문자열
 * @param def null일경우 리턴 디퐅트값
 * @returns
 */
function formatDay(str, def){
    if (def == 'undefined' || def == null){
        def = '';
    }

    var rtn = '';
    if (str != 'undefined' && str != null && str != ''){
        rtn = replace(str,dateFormatSplit,'');
        if (rtn > 7){
            rtn = rtn.substr(0,4)+'-'+rtn.substr(4,2)+'-'+rtn.substr(6,2);
        }else{
            rtn = str;
        }
    }else if(str == null || str == ''){
        rtn = def;
    }else{
        rtn = def;
    }
    return rtn;
}

/**
 * 날짜형태 문자열의 포맷 YYYY-MM-DD 00:00
 * @param str 입력문자열
 * @param def null일경우 리턴 디퐅트값
 * @returns
 */
function formatDayTime(str, def){
    if (def != 'undefined' && def != null){
        def = '';
    }
    var rtn = '';
    if (str != 'undefined' && str != null){
        rtn = replace(str,dateFormatSplit,'');
        if (rtn.length == 14){
            rtn = rtn.substr(0,4)+'-'+rtn.substr(4,2)+'-'+rtn.substr(6,2)+' '+rtn.substr(8,2)+':'+rtn.substr(10,2)+':'+rtn.substr(12,2);
        }else if(rtn.length == 8){
            rtn = rtn.substr(0,4)+'-'+rtn.substr(4,2)+'-'+rtn.substr(6,2);
        }else{
            rtn = str;
        }
    }else{
        rtn = def;
    }
    return rtn;
}

/**
 * input obj 입력값(yyyy.MM.dd, yyyy-MM-dd) 날짜 체크
 * @param obj
 * @return
 */
function chkValDate(obj){
    if (obj.value != ''){
        var src = replace(obj.value,'.','');
        src = replace(src,'-','');
        if (!isValidDate(src)){
            //alert('날짜 형식에 맞지 않습니다.');
            obj.value = '';
            obj.focus();
        }
    }
}
/**
 * @날짜 연산 스크립트
 * @param today
 * @param t
 * @return
 */
function getThatday(today,t){ //날짜, 일차를 파라메터로 받는다.
    if(today == ''){
        return '';
    }
    var pdate=new Array();
    var pday=today.split(dateFormatSplit); //날짜를 구분자로 나누어 배열로 변환한다.
    var ptoday=new Date(pday[0],pday[1]-1,pday[2]); //데이트객체 생성한다.
    var ptimestamp=ptoday.valueOf()+1000*60*60*24*t; //t일후의 타임스탬프를 얻는다. 음수라면 이전날짜를 얻는다.
    var thatday=new Date(ptimestamp); //t일후의 날짜객체 생성한다.

    pdate[pdate.length]=thatday.getYear(); //년

    if (thatday.getMonth()+1 < 10){
        pdate[pdate.length]="0"+(thatday.getMonth()+1); //월
    }else{
        pdate[pdate.length]=thatday.getMonth()+1; //월
    }

    if (thatday.getDate() < 10){
        pdate[pdate.length]="0"+thatday.getDate(); //일
    }else{
        pdate[pdate.length]=thatday.getDate(); //일
    }
    return pdate.join(dateFormatSplit); //배열을 / 구분자로 합쳐 스트링으로 변환후 반환
}

/*
* 설명 : INPUT BOX값 금액패턴으로 변환 - 소숫점 몇자리까지 표현할지
* 수정자 : 김삼도 2009.05.04
*예)) <input onchange="setValue(this,1)">
*
*/
function setValue(obj, val) {
    obj.value = chgDigit(obj.value, val);
}

function chgDigit(pInputData, depth) {

    var inputData = 0.0;
    var dumy = '';
    for (var idx=0;idx<depth;idx++) dumy += '0';


    if (typeof(pInputData) == 'string') {
        pInputData = pInputData.replace(/(^\s*)|(\s*$)/g, "").replace(/,/g, "");

        if  (pInputData=="" || isNaN(pInputData)) {
            if (depth == 0)
                return "0";
            else
                return "0."+dumy;
        }

        inputData = parseFloat(pInputData, 10);
    } else if (typeof(pInputData) == 'number') {
        inputData = pInputData;
    }

    var retValue;

    var p = Math.pow(10, depth);
    retValue = Math.round(inputData*p)/p;

    if (retValue.toString().indexOf(".") < 0) {
        retValue = retValue.toString()+"."+dumy;
    }
    else {
        retValue = retValue.toString()+dumy;
    }

    if (depth == 0)
        retValue = retValue.substring(0,retValue.indexOf("."));
    else
        retValue = retValue.substring(0,retValue.indexOf(".")+depth+1);

    return addComma(retValue);

}

function SetFormValue(f, n, v, sep) {

    var f = document.all;

    if (!f || !f[n])
        return false;

    switch (f[n].type) {
        case 'text':
        case 'password':
            f[n].value = v;
            break;
        case 'textarea':
            f[n].text = v;
            break;
        case 'checkbox':
            if (f[n].value == v)
                f[n].checked = true;
            break;
        case 'select-one':
            for ( var i = 0; i < f[n].options.length; i++)
                if (f[n].options[i].value == v)
                    f[n].options[i].selected = true;
            break;
        default:
            if (sep) {
                var val = v.split(sep);
                for ( var i = 0; i < f[n].length; i++) {
                    for ( var j = 0; j < val.length; j++) {
                        if (f[n][i].value == val[j])
                            f[n][i].checked = true;
                    }
                }
            } else {
                for ( var i = 0; i < f[n].length; i++)
                    if (f[n][i].value == v)
                        f[n][i].checked = true;
            }
    }
}

/**
 * 사업자 번호 유효성 체크
 * @param vencod
 * @returns {Boolean}
 */
function check_busino(vencod) {
    vencod = vencod.replaceAll("-", "");
    var sum = 0;
    var getlist =new Array(10);
    var chkvalue =new Array("1","3","7","1","3","7","1","3","5");
    for(var i=0; i<10; i++) {
        getlist[i] = vencod.substring(i, i+1);
    }
    for(var i=0; i<9; i++) {
        sum += getlist[i]*chkvalue[i];
    }
    sum = sum + parseInt((getlist[8]*5)/10);
    sidliy = sum % 10;
    sidchk = 0;
    if(sidliy != 0) {
        sidchk = 10 - sidliy;
    }
    else {
        sidchk = 0;
    }
    if(sidchk === Number(getlist[9])) {
        return true ;
    }
    return false;
}

//입력된 파일의 확장자 리턴
function getValidFileExt(str){
    var ext = str.substr(str.lastIndexOf(".") + 1).toUpperCase();
    var extCheck = false;

    if(ext == "XLS"  || ext == "DOC"  || ext == "PPT"  ||
        ext == "XLSX" || ext == "DOCX" || ext == "PPTX" ||
        ext == "GIF"  || ext == "JPG"  || ext == "PNG"  ||
        ext == "BMP"  || ext == "JPEG" || ext == "PDF"  ||
        ext == "HWP"
    ){
        extCheck = true;
    }

    return extCheck;
}

// 입력된 파일의 이미지파일 여부
function getValidFileExtImage(str){
    var ext = str.substr(str.lastIndexOf(".") + 1).toUpperCase();
    var extCheck = false;

    if(ext == "JPG"  || ext == "JPEG"  || ext == "GIF" ||
        ext == "PNG"  || ext == "BMP"
    ){
        extCheck = true;
    }

    return extCheck;
}
/**********************************************
 윈도우 관련
 ***********************************************/
/**
 * @F5 새로고침 방지.
 * @return
 */
/*
function doNotReload(){
    if(    (event.ctrlKey == true && (event.keyCode == 78 || event.keyCode == 82))
        || (event.keyCode == 116) )
    {
      event.keyCode = 0;
      event.cancelBubble = true;
      event.returnValue = false;
    }
}
document.onkeydown = doNotReload;
*/

/**
 * @우클릭 방지.
 * @param e
 * @return
 */
/*
function right(e) {
	if (navigator.appName == 'Netscape' &&
	(e.which == 3 || e.which == 2))
	return false;
	else if (navigator.appName == 'Microsoft Internet Explorer' &&
	(event.button == 2 || event.button == 3)) {
	alert("마우스 우클릭은 사용하실 수 없습니다.");
	return false;
	}
	return true;
	} */
//document.onmousedown=right;
//뒤로가기 방지
//window.history.forward(0);
var NN = (navigator.appName == "Netscape") ? 1: 0;

/*키코드 33 부터 47 까지*/
//키코드 33~47까지 순대대로 ! " # $ % & ' ( ) * + , - . /
function CheckChar0() {
    if ( !NN ) {
        if ( event.keyCode == 33 || event.keyCode == 34 || event.keyCode == 35 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 42 || event.keyCode == 43 || event.keyCode == 44 || event.keyCode == 45 || event.keyCode == 46 ) {
            //해당 이벤트가 일어난 키에 대한 코드 값을 확인 값을 반환 하지 않습니다.
            event.returnValue = false;
        }
    } else {
        if ( event.keyCode == 33 || event.keyCode == 34 || event.keyCode == 35 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 42 || event.keyCode == 43 || event.keyCode == 44 || event.keyCode == 45 || event.keyCode == 46 )
            return false;
    }
}

function CheckChar1() {
    if ( !NN ) {
        if ( event.keyCode > 32 && event.keyCode < 48 ) {
            //해당 이벤트가 일어난 키에 대한 코드 값을 확인 값을 반환 하지 않습니다.
            event.returnValue = false;
        }
    } else {
        if ( event.which > 32 && event.which < 48)
            return false;
    }
}

/*키코드 58 부터 64 까지*/
//키코드 58~64까지 순대대로 : ; < = > ? @
function CheckChar2() {
    if ( !NN ) {
        if ( event.keyCode > 57 && event.keyCode < 65)
            event.returnValue = false;
    } else {
        if ( event.which > 57 && event.which < 65)
            return false;
    }
}

/*키코드 91 부터 96 까지*/
//키코드 91~96까지 순대대로 [ \ ] ^ _
function CheckChar3() {
    if ( !NN ) {
        if ( event.keyCode > 90 && event.keyCode < 97)
            event.returnValue = false;
    } else {
        if ( event.which > 90 && event.which < 97)
            return false;
    }
}

/*키코드 123 부터 125 까지*/
//키코드 123~125까지 순대대로 { | }
function CheckChar4() {
    if ( !NN ) {
        if ( event.keyCode > 122 && event.keyCode < 126)
            event.returnValue = false;
    } else {
        if ( event.which > 122 && event.which < 126)
            return false;
    }
}






function cleanQueryTerm( str ) {
    var specialChars='~`!@#$%%^&*-=+\|[{]};:\',<.>/?"';
    var i, j;
    if (str == '') {
        alert('No Input');
        return false;
    }
    for (i = 0; i < str.length; i++) {
        for (j = 0; j < specialChars.length; j++) {
            if (str.charAt(i) == specialChars.charAt(j))
                str = str.replace(str.charAt(i), "");
        }
    }
    return str;
}

/**
 * 보안 관련 html특수 문자 replace
 * @param value
 * @returns
 */
function replaceHtmlEntity(value){
    value = value.replaceAll("<","&lt;");
    value = value.replaceAll(">","&gt;");
    value = value.replaceAll('"','&quot;');
    value = value.replaceAll("'",'&#39;');
    return value;
}

/**
 * 보안 관련 html특수 문자 replace
 * @param form
 */
function formReplace(form){
    $(form).find("input").each(function(){
        $(this).val(replaceHtmlEntity($(this).val()));
    });

    $(form).find("textarea").each(function(){
        $(this).text(replaceHtmlEntity($(this).text()));
    });
}

function fncRoundPrecision(val, precision){
    var p = Math.pow(10, precision);
    return Math.round(val * p) / p;
}

Math.roundPrecision = function(val, precision) {
    var p = this.pow(10, precision);
    return this.round(val * p) / p;
}



/**
 * 달력 파라메터 변수
 */
var datePikerData = function() {
    var today = new Date();
    var start_year = today.getFullYear() - 10;
    var end_year = today.getFullYear() + 10;

    return {
        //inline: true,
        changeMonth: true,
        changeYear: true,
        yearRange: start_year+":"+end_year,
        dateFormat: "yy-mm-dd",
        autoSize: false,
        locale : "en",
        monthNames: ['1 월','2 월','3 월','4 월','5 월','6 월',
            '7 월','8 월','9 월','10 월','11 월','12 월'],
        monthNamesShort: ['1 월','2 월','3 월','4 월','5 월','6 월',
            '7 월','8 월','9 월','10 월','11 월','12 월'],
        dayNames: ['일','월','화','수','목','금','토'],
        dayNamesShort: ['일','월','화','수','목','금','토'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        yearSuffix: '',
        showMonthAfterYear: true,
        firstDay: 1,
        showOn : 'both',
        buttonImageOnly: true,
        buttonImage : '/images/common/ico_calendar.gif'
        //showButtonPanel: true,
        //closeText: '닫기',
        //currentText : ''
    };
}();


function setInputCalendar(){
    if ($(".calendar").length > 0){
        $(".calendar").keypress( function(){num_only(event);} )
            .keyup( function(){formatDate(event,this);} )
            .focus( function(){this.select();} )
            .blur( function(){chkValDate(this);} )
        ;
        $(".calendar").css('margin-right','4px');
        $(".calendar").css('position','relative');
        /*$(".calendar").css('z-index','100000');*/

        $(".calendar").datepicker(datePikerData);
        $(".calendar").each(function(index){
            $(this).val(formatDay($(this).val()));
        });
    }
}

function setInputAccUserSearchPop(){
    if ($(".accUserPop").length > 0){
        $('.accUserPop').keyup(function(e) {
            if (e.keyCode == 13){
                accUserPop(this);
            }
        });
    }
}

/**
 * 폼 파라메터 변수
 * @param form
 * @returns
 */
var formParams  = function(form) {
    var forms = form.serializeArray() ;
    var  params = {};
    var formChk = true ;
    $.each(forms, function(a, element, c){
        var node = params[element.name]
        if ("undefined" !== typeof node && node !== null) {
            if ($.isArray(node)) {
                node.push(element.value)
            } else {
                params[element.name] = [node, element.value]
            }
        } else {
            var obj = $("#"+ element.name) ;
            var _cls = (obj.prop("class")?? "") ;
            if( _cls.includes("hasDatepicker") ||_cls.includes("telno") ||_cls.includes("bizno") ||_cls.includes("ym")||_cls.includes("ymd") ){
                element.value = element.value.replaceAll("-","");
            }
            //숫자
            if( _cls.includes("number")){
                element.value = element.value.replaceAll(",","")
            }
            params[element.name] = element.value
        }
    }) ;

    return params;
};

/**
 * 날짜에서 "-" 또는 "/",".",":" 를 없앤다.
 * @param	str		날짜 형식 문자열
 * @return	YYYYMMDD 형식의 날짜 문자열
 */
function deleteDateFormatStr(str) {
    var temp = '';
    for (var i = 0; i < str.length; i++) {
        if (str.charAt(i) == '-' || str.charAt(i) == '.' || str.charAt(i) == '/' || str.charAt(i) == ':' ) {
            continue;
        } else {
            temp += str.charAt(i);
        }
    }
    return	temp;
}

function getCookie(name){
    var wcname = name + '=';
    var wcstart, wcend, end;
    var i = 0;

    while(i <= document.cookie.length) {
        wcstart = i;
        wcend   = (i + wcname.length);
        if(document.cookie.substring(wcstart, wcend) == wcname) {
            if((end = document.cookie.indexOf(';', wcend)) == -1)
                end = document.cookie.length;
            return document.cookie.substring(wcend, end);
        }

        i = document.cookie.indexOf('', i) + 1;

        if(i == 0)
            break;
    }
    return '';
}

function setCookie(name, value, expiredays) {
    var today = new Date();
    today.setDate(today.getDate() + expiredays);

    document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';';
}

//업로드 형식 체크.(xml)
function checkXmlFileExtention(fileName){
    var availExtention = "xml";

    var check = false;
    var ext = '';
    if (fileName != ''){
        ext = fileName.substring(fileName.lastIndexOf(".")+1).toLowerCase();
        if (availExtention.indexOf(ext) == -1 ){
            alert("업로드 가능한 형식이 아닙니다.\r\n(가능한 형식:"+availExtention+")");
            check = false;
        }else{
            check = true;
        }
    }else{
        check = true;
    }
    return check;
}

/**
 * 날짜 입력값 폼 전송 전 '.','-' 제거
 */
function setInputCalendarValueForSubmit(){
    $(".calendar").each(function(index) {
        var temp = replace($(this).val(),'-','');
        temp = replace(temp,'.','');
        temp = replace(temp,':','');
        $(this).val(temp);
    });
}

/**
 * 팝업 기본 오픈
 * @param url
 * @param popNm
 * @param wid
 * @param hei
 */
function basicPopupOpen(url, popNm, wid, hei) {
    var popWidth = wid; //팝업 넓이
    var popHeight = hei; //팝업 높이


    var winHeight = document.body.clientHeight; //현재창의 높이
    var winWidth = document.body.clientWidth; //현재창의 너비
    var winX = window.screenLeft; //현재창의 x좌표
    var winY = window.screenTop; //현재창의 y좌표
    var newLeft = winX + (winWidth - popWidth)/2;
    var newTop = winY + (winHeight - popHeight)/2;


    var openWin = window.open(url, popNm, 'top=' + newTop + ',left=' + newLeft
        + ',height=' + popHeight + ',width=' + popWidth
        + ',scrollbars=1,resizable=1,status=1,toolbar=0,menubar=0');
    openWin.focus();
}

/**
 * 숫자입력 input
 */
function setInputNmber(){
    if ($(".number").length > 0){
        $(".number").css('text-align','right');
        $(".number").css('ime-mode','disabled');
        $(".number").on('change, keyup', function(){comma(this); });
        $(".number").numeric({allow:',-'});
    }
}


/**
 * 전화번호 input
 */
function setInputTelNo(){


    if ($(".telno").length > 0){
        $(".telno").keyup( function(){
            var str = this.value ;
            var nStr = str.replaceAll("-","") ;
            if(nStr.length == 9 || nStr.length == 10 || nStr.length == 11){
                nStr = nStr.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
                this.value  = nStr ;
            }else{
                this.value  = nStr ;
            }

        });
    }

}

/**
 * 전화번호 input
 */
function setInputTime(){


    if ($(".TimeNo").length > 0){

        $(".TimeNo").keyup( function(){
            var str = this.value ;
            var nStr = str.replaceAll(":","") ;
            if(nStr.length == 4 ){
                nStr = nStr.replace(/^([1-9]|[01][0-9]|2[0-3])([0-5][0-9])$/, "$1:$2");
                this.value  = nStr;

            }else{
                this.value  = nStr ;
            }
        });
    }

}


/**
 * 사업자 번호 input
 */
function setInputbizNo(){
    if ($(".bizno").length > 0){
        $(".bizno").keyup( function(){
            var str = this.value ;
            var nStr = str ;
            nStr = formatBizNo(nStr) ;
            this.value  = nStr ;
        });
    }
}


//submit 시에 replace해줌. 날짜 형식을..
function setInputCalendarValueForSubmit(){
    $(".calendar").each(function(index) {
        var temp = replace($(this).val(),'-','');
        temp = replace(temp,'.','');
        temp = replace(temp,':','');
        $(this).val(temp);
    });
}

/**
 * 목록 그리드 리사이즈
 */
function jqxgridResizeForList(){
    //자동완성 금지
    $("input").attr("autocomplete", "off");
    if ($(".local_sch").length > 0 && $("#grid").length > 0){
        var gridHeight = Number($(window).height()) - (80+ $("#grid").offset().top );
        //console.log("gridHeight", gridHeight, Number($(window).height()), $("#grid").offset().top  );
        gridHeight = gridHeight < 400 ? 400 : gridHeight ;
        $("#grid").parent().height(gridHeight);
    }
}

/**
 * 목록 그리드 리사이즈 : 검색영역 없을 경우
 */
function jqxgridResizeForListNonSearch(){
    if ($(".local_sch").length > 0 && $("#grid").length > 0){
        var gridHeight = Number($(window).height()) - 230;
        gridHeight = gridHeight < 400 ? 400 : gridHeight ;
        $("#grid").jqxGrid({ height: gridHeight });
    }
}

//submit 시에 replace해줌. 숫자 형식을...
function setNumberValueForSubmit(){
    $(".amount").each(function(index) {
        $(this).val(replace($(this).val(),',',''));
    });
    $(".number").each(function(index) {
        $(this).val(replace($(this).val(),',',''));
    });
}



function fn_containsValueInArray(array, _value ) {
    if (array == null) {
        return false;
    }
    return  array.some((item)=> item ==_value)  ;
}

function  fn_fillBlank(wrapperId, prefix, exceptedIdArray) {
    $('#'+wrapperId+' [id]').each(function(k, t ){
        if($(t).prop('tagName') != "DIV") {
            var _check = true;
            if ((prefix ?? "") != "") {
                var _id = t.id.toUpperCase() ;
                var _name = t.name.toUpperCase() ;
                var _prefex = prefix.toUpperCase()  ;
                if (! ( _id.startsWith(_prefex) || _name.startsWith(_prefex)) ) {
                    _check = false;
                }
            }
            if (exceptedIdArray != null) {
                if(exceptedIdArray.some((item) => (item.toUpperCase() == _id || item.toUpperCase() == _name) )){
                    _check =false ;
                }
            }
            if (_check) {
                $(t).val("") ;
            }
        }
     }
  ) ;
}

function fn_fillValue(wrapperId, prefix, map, exceptedIdArray) {
    for (var key in map) {
        if ($('#' + wrapperId + ' [id^=' + prefix + key + ']').length < 1 || fn_containsValueInArray(exceptedIdArray, key) == true) {
            continue;
        }
        var target = $("#"+prefix + key);
        if (target != null) {
            target.val((map[key] ?? ""));
        }
    }
}

//form 유효성 체크
function fn_chkForm(formName){

    var forms = $("#"+formName).serializeArray();
    var  params = {};
    var formChk = true ;
    $.each(forms, function(a, element, c){
        var node = params[element.name]
        if ("undefined" !== typeof node && node !== null) {
            if ($.isArray(node)) {
                node.push(element.value)
            } else {
                params[element.name] = [node, element.value]
            }
        } else {
            var obj = $("#"+ element.name) ;
            var _cls = (obj.prop("class")?? "") ;

            //mask
            if( _cls.includes("maskedinput") && element.value != "" ){
                element.value = element.value.replaceAll("_","");
                element.value = element.value.replaceAll(":","");
                element.value = element.value.replaceAll(",","");
            }

            //필수항목
            if((obj.prop("required") == true || _cls.includes("required")) && element.value == ""){
                formChk = false ;
                alert("필수항목 입니다.") ;
                obj.focus() ;
                return false ;
            }


            //전화번호 check !!
            if( _cls.includes("telno") && element.value != "" ){
                var ck =  chktel(element.value) ;
                if(ck == "false" ){
                    formChk = false ;
                    alert("전화번호 형식이 올바르지 않습니다  ") ;
                    obj.focus() ;
                    return false ;
                }else{
                    element.value = ck ;
                }
            }
            //이메일  check !!
            if( _cls.includes("email") && element.value != ""){
                var ck =  chkEmail(element.value) ;
                if(!ck ){
                    formChk = false ;
                    alert("이메일 형식이 올바르지 않습니다  ") ;
                    obj.focus() ;
                    return false ;
                }
            }
            //사업자번호
            if( _cls.includes("bizno") && element.value != "" ){
                var ck =  check_busino(element.value) ;
                if(!ck ){
                    formChk = false ;
                    alert("사업자번호 형식이 올바르지 않습니다  ") ;
                    obj.focus() ;
                    return false ;
                }else{
                    element.value = element.value.replaceAll("-","");
                }
            }
            //날짜
            if( _cls.includes("hasDatepicker")){
                element.value = element.value.replaceAll("-","");
            }
            //숫자
            if( _cls.includes("number")){
                element.value = element.value.replaceAll(",","")
            }
            params[element.name] = element.value
        }
    }) ;
    if(formChk){
        return params ;
    }else{
        return false ;
    }
}
//서브미션 함수
function fn_submission(p_subId, p_url, p_params, p_async= false, p_callback , p_type ="POST"){
    try {
        var pJson = Object.assign({}, { 'submissionId':p_subId }, p_params);
        if (p_async) {
            $('body').append('<div  id="subloading" class="submissionloading"></div>');
        }
        const _url = p_url.replaceAll("./", "/spaceadd/sale/");
        $.ajax({
            type:  p_type,
            url: _url,
            contentType: "application/json; charset=UTF-8",
            dataType: "json",
            async: (p_async ?? false) ,
            data: JSON.stringify(pJson),
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                /*
                console.log("error", XMLHttpRequest );
                console.log("서버 응답 텍스트:", XMLHttpRequest.responseText);
                console.log("textStatus",  textStatus  );
                console.log("errorThrown",  errorThrown);
                 */
                $('.submissionloading').hide();
                if (p_async) {
                    $('.submissionloading').remove();
                }
               alert(textStatus);
               return false;
            },
            success: function (data) {
                try{
                    $('.submissionloading').hide();
                    if (p_async) {
                        $('.submissionloading').remove();
                    }
                    //세션체크 추가
                    if (data.ERRMSG != null && data.ERRMSG != "") {
                        //세 에러메시지를 띄운다
                        alert(data.ERRMSG);
                        rtn = false;
                        return false;
                    }
                    if ((data.messageInfo ?? "") != "" ) {
                        alert(data.messageInfo);
                    }
                    var submissionID = p_subId ;
                    if (typeof (p_callback) == "function") {
                        p_callback(submissionID,data );
                    } else {
                        var callbacks = $.Callbacks();
                        callbacks.add(eval(p_callback));
                        callbacks.fire(submissionID,data );
                    }
                }catch (e) {
                    console.log(e)
                }
            }
        });
    } catch (e1) {
        $('.submissionloading').hide();
        if (p_async) {
            $('.submissionloading').remove();
        }
        console.log(e1) ;
    }
}

//회사 검색 팝업
function fn_commFindComppPop(compType, num, com_id='', com_nm = ''){
    try{
        var winTlt ="" ;
        if(compType =="AAC01") {
            winTlt = "광고주";
        }else if(compType =="AAC02"){
            winTlt="매체사" ;
        }else if(compType =="AAC03"){
            winTlt="광고회사" ;
        }else{
            winTlt="거래처" ;
        }
        var url ="/spaceadd/sale/common/commP_comp_list.php?compType="+compType+"&callBack=fn_commSetCompPop"  ;
        if(com_id != "" ){
            url = url + "&com_id="+com_id+"&com_nm="+com_nm
        }
        if(num != "" ){
            url = url +"&num="+num ;
        }
        basicPopupOpen(url, winTlt, "1200", "620")  ;
    }catch (e) {
        console.log(e)
    }
};


function fn_commSetCompPop(voJson){
    if((voJson.com_id ?? "" ) != ""){
        $("#"+voJson.com_id).val(voJson.comp_seq);
        $("#"+voJson.com_nm).val(voJson.comp_nm);
    }else{
        if(voJson.comp_type =="AAC01") {
            $("#cli_seq"+voJson.num).val(voJson.comp_seq);
            $("#cli_nm"+voJson.num).val(voJson.comp_nm);
        }else if(voJson.comp_type =="AAC02") {
            $("#comp_seq"+voJson.num).val(voJson.comp_seq);
            $("#comp_nm"+voJson.num).val(voJson.comp_nm);
        }else if(voJson.comp_type =="AAC03") {
            $("#agncy_seq"+voJson.num).val(voJson.comp_seq);
            $("#agncy_nm"+voJson.num).val(voJson.comp_nm);
        }else if(voJson.comp_type =="AAC04") {
            $("#rep_seq"+voJson.num).val(voJson.comp_seq);
            $("#rep_nm"+voJson.num).val(voJson.comp_nm);
        }
    }
    //설정후 추가 실행
    if( typeof fn_commSetCompPopCallback == 'function' ) {
        fn_commSetCompPopCallback(voJson)   ;
    }
}
//회사 삭제
function fn_commDelComp(comp_type, num='', com_id='', com_nm = ''){
    if(com_id != "" ){
        $("#" + com_id).val('');
        $("#" + com_nm).val('');
    }else{
        if(comp_type =="AAC01") {
            $("#cli_seq" + num).val('');
            $("#cli_nm" + num).val('');
        }else if(comp_type =="AAC02") {
            $("#comp_seq"+num).val('');
            $("#comp_nm"+num).val('');
        }else if(comp_type =="AAC03") {
            $("#agncy_seq"+num).val('');
            $("#agncy_nm"+num).val('');
        }else if(comp_type =="AAC04") {
            $("#rep_seq"+num).val('');
            $("#rep_nm"+num).val('');
        }
    }

}


//소재 검색 팝업
function fn_commFindMtrlPop( num , cli_seq) {
    try{
        var winTlt ="소재 검색" ;
        var url ="/spaceadd/sale/common/commP_mtrl_list.php?callBack=fn_commSetMtrlPop"  ;
        if(num != "" ){
            url = url +"&num="+num ;
        }
        if(cli_seq != "" ){
            url = url +"&cli_seq="+cli_seq ;
        }
        if($("#mtrl_sec").val() != ""){
            url = url +"&mtrl_sec="+$("#mtrl_sec").val() ;
        }
        basicPopupOpen(url, winTlt, "800", "620")  ;
    }catch (e) {
        console.log(e)
    }
};

//소재세팅
function fn_commSetMtrlPop(voJson){
    try{
        $("#mtrl_seq"+voJson.num).val(voJson.mtrl_seq);
        $("#mtrl_nm"+voJson.num).val(voJson.mtrl_nm);
    }catch (e) {
        console.log(e)
    }

}
//소재 삭제
function fn_commDelMtrl(  num=''){
    $("#mtrl_seq" + num).val('');
    $("#mtrl_nm" + num).val('');
}

function fn_getLastDay(str, split ){
    var dateStr = str.replaceAll("-", "")  ;

    var yyyy = dateStr.substring(0,4);
    var mm = parseInt(dateStr.substring(4,6), 10);

    var date = new Date(yyyy, mm, 0 );
    yyyy = date.getFullYear();
    mm = date.getMonth()+1;
    dd = date.getDate();

    if (mm < 10)
        mm = "0" + mm;
    if (dd < 10)
        dd = "0" + dd;

    return yyyy + split + mm + split + dd;
}

/**
 * 날짜를 입력받아 주중만 더하기
 * @param date
 * @param daysToAdd
 * @returns {string}
 */

function fn_addDaysWeekdays(startDate, workdaysToAdd) {
    startDate = startDate.replaceAll("-", "")  ;
  // 입력받은 yyyymmdd 날짜를 Date 객체로 변환
  const year = parseInt(startDate.substring(0, 4), 10); // 연도
  const month = parseInt(startDate.substring(4, 6), 10) - 1; // 월 (0부터 시작)
  const day = parseInt(startDate.substring(6, 8), 10); // 일
  const resultDate = new Date(year, month, day);

  let workdayCount = 0;

  while (workdayCount < workdaysToAdd) {
    resultDate.setDate(resultDate.getDate() + 1); // 하루 추가
    const dayOfWeek = resultDate.getDay(); // 요일 (0: 일요일, ..., 6: 토요일)

    if (dayOfWeek !== 0 && dayOfWeek !== 6) {
      // 주말이 아닌 경우만 카운트 증가
      workdayCount++;
    }
  }

  // 결과를 yyyymmdd 형식으로 반환
  const finalYear = resultDate.getFullYear();
  const finalMonth = String(resultDate.getMonth() + 1).padStart(2, '0'); // 월 (1부터 시작)
  const finalDay = String(resultDate.getDate()).padStart(2, '0'); // 날짜
  return  finalYear+"-"+finalMonth +"-"+finalDay ;
}
