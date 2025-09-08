/*
 * 
 *
String class prototype function
    String.prototype.startsWith(psWith)                     // 지정한 문자열로 시작하는지 판단
    String.prototype.endsWith(psWith)                       // 지정한 문자열로 끝나는지 판단
    String.prototype.isEmpty()                              // 빈 문자열인지 판단
    String.prototype.trimRight(psTrim)                      // 지정한 문자열로 오른쪽 잘라내기, 미지정시 오른쪽 공백문자 제거
    String.prototype.trimLeft(psTrim)                       // 지정한 문자열로 왼쪽 잘라내기, 미지정시 왼쪽 공백문자 제거
    String.prototype.getByteLength()                        // 스트링의 자릿수를 Byte 단위로 환산하여 알려준다. 영문, 숫자는 1Byte이고 한글은 2Byte이다.(자/모 중에 하나만 있는 글자도 2Byte이다.)
    String.prototype.simpleReplace(oldStr, newStr)          // 스트링 내에 있는 특정 스트링을 다른 스트링으로 모두 변환한다
    String.prototype.trim()                                 // 스트링의 앞과 뒤에 있는 white space 를 제거한다.
    String.prototype.trimAll()                              // 스트링 내에 있는 white space를 모두 제거한다.
    String.prototype.cut(start, length)                     // 스트링의 특정 영역을 잘라낸다.
    String.prototype.insert(index, str)                     // 스트링의 특정 영역에 주어진 스트링을 삽입한다.


Date class prototype function
    Date.prototype.after(years, months, dates, hours, minutes, seconds, mss) // 지정된 날짜만큼 시간이 지난 후의 날짜를 반환
    Date.prototype.before(years, months, dates, hours, minutes, seconds, mss) // 지정된 날짜만큼 이전의 날짜를 반환
    Date.prototype.format(pattern)                          // Date 객체가 가진 날짜를 지정된 포멧의 스트링으로 반환



TimeSpan class
    TimeSpan(pdDate1st, pdDate2nd, pbCalcOnlyDay)       // 생성자, 두 날짜간 차이를 계산
    getSpanDays()
    getSpanHours()
    getSpanMinutes()
    getSpanSeconds()
    getSpanMilliseconds()
    
    
DateUtil static class
    format(pdDate, psPattern)                           // 날짜를 지정한 패턴의 문자열로 반환
    checkDateString(psYear, psMonth, psDay)             // 올바른 날짜 문자열인지 체크
    checkDate(pnYear, pnMonth, pnDay)                   // 올바른 날짜인지 체크
    toDate(psDateTime, psPattern)                       // 날짜 문자열을 Date형으로 변환후 반환(Date)
    getMonthLastDate(pnYear, pnMonth)                   // 해당월의 말일 반환 (int)
    getPrevMonthLastDate(pdBaseDate)                    // 지정한 날짜의 전월 말일 반환(int)
    getDaySpan(pdDate1st, pdDate2nd)                    // 두 날짜간 일수 반환(int)
    
    
ValueUtil static class
    isNull(puValue)                                     // Null 여부 체크
    isNumber(psValue, pbForce)                          // Number형 value인지 체크
    fixNull(puValue)                                    // null이거나 정의되지 않은경우 ""로 반환
    fixBoolean(puValue)                                 // Boolean형으로 반환
    fixNumber(puValue)                                  // Number형으로 반환
	trunc(pnS, pnPos)									// 소수점 자르기
	
Page class
    getUserInfo()                                       // 세션정보 반환
    getInstance(psInstancePath)                         // 지정된 노드의 xml instance 를 반환
    getScriptModel()                                    // script model 을 반환
    getControl(psControlId)                             // 지정된 컨트롤의 ID를 이용 컨트롤 객체를 반환
    getControls()                                       // 컨트롤 객체 전체를 배열 형태로 반환
    getRepeatControls()                                 // 리피트 컨트롤들을 배열 형태로 반환
    getControlIds()                                     // 컨트롤의 ID를 배열 형태로 반환
    getInnerControlIds(psCtlId)                         // 지정한 컨트롤의 하위 컨트롤 ID를 배열 형태로 반환
    getIDListFromType(psType)                           // 지정된 컨트롤 타입과 일치하는 컨트롤들의 ID를 반환
    getPate(psViewerName)                               // 지정한 Viewer 의 이름과 일치하는 Page 객체를 반환
    getContext()                                        // context를 반환
    setCtrlVisible(pbVisible, psCtrlId[, ...])          // 지정한 컨트롤의 visible 속성을 설정
    setCtrlEnable(pbEnable, psCtrlId[, ...])            // 지정한 컨트롤의 enable 속성을 설정
    setCtrlFocus(psCtrlId)                              // 지정한 컨트롤이 focus를 받도록 설정
    nextCtrlFocus()
    nextCtrlFocus(psCtrlId)
    nextCtrlFocus(pbForward)
    nextCtrlFocus(psCtrlId, pbForward)                  // 다음 컨트롤의 focus 를 지정한다.
    resetCtrl(psCtrlId[, ...])                          // 지정한 컨트롤의 값을 초기화 한다.
    setCtrlFromRef(psCtrlId, psRef)                     // 지정한 참조 노드의 값을 지정한 컨트롤에 입력한다.
    getCtrlFromRef(psRef)                               // 지정한 노드를 참조하는 컨트롤의 ID를 반환한다.
    popup(psFile, pnWidth, pnHeight, poObj)             // 팝업창을 띄운다.
    getFileName(pbDlgType, psFilter)                    // 파일을 선택하는 다이얼로그를 띄운다.
    refresh()                                           // 화면내의 모든 컨트롤들의 값을 다시 설정한다.
    refreshCtrl(psCtrlId[, ...])                        // 지정한 컨트롤들의 값을 다시 설정한다.
    refreshBind(psBindId)                               // 지정한 컨트롤에 설정된 bind를 다시 계산한다.
    rebuild()                                           // 화면 내의 모든 컨트롤들을 rebuild 한다.
    rebuildCtrl(psCtrlId[, ...])                        // 지정한 컨트롤을 rebuild 한다.
    onSubmissionError()                                 // 서브미션의 에러 메시지를 보여준다.
    getControlsByAttr(varAttrNm, varAttrValue)          // 지정된 속성값과 동일한 컨트롤들의 ID를 배열 형태로 반환
    validateNotNull(varAttrNm, varAttrValue)            // NotNull Data 입력 여부 확인
    setDefaultUrl(varSendUrl)                           // Viewer의 default_url session을 설정
    getDefaultUrl()                                     // Viewer의 default_url session을 반환
    getMesssage()                                       // submission 수행 후 서버로부터 전달된 메시지 반환
    removeMessage()                                     // submission 수행 후 서버로부터 전달된 메시지를 삭제한다.
    send(varSubmissionId)                               // 지정된 submission을 수행한다.
    sendAddParam(varSubmissionId, varParamData)         // 지정된 submission을 ParamData을 포함하여 수행한다.
    isPopup()                                           // 현재 창이 팝업인지를 판별
    close()                                             // 현재 창을 닫는다.

StrFmtUtil static class
    getFmtVal(psType, psFormat, psValue)                // 인자로 넘겨준 value를 지정된 형식(Xtm Input컨트롤의 Format)을 적용해서 리턴 한다.
    toNumFormat(psValue)                                // 숫자를 천단위 ,구분 문자열로 반환 : ex) StrFmtUtil.toNumFormat("-1234567.89") == "-1,234,567.89"
    toNumUnFormat(psValue)                              // 순수숫자만 포함하는 문자열로 반환(음수기호포함)
    toTimeFormat(psValue)                               // 시각표현 문자열 HH:mm로 반환
    toDateFormat(psValue, psDelim)                      // YYYYMMDD문자열을 YYYY-MM-DD 형태로 반환
    toDateUnFormat(psValue)                             // Undo toDateFormat
    toPostNumFormat(psValue)                            // 우편번호 000-000 형태로 반환
    toPostNumUnFormat(psValue)                          // Undo toPostNumFormat
    addQuotation(psValue)                               // 문자열 싱글쿼테이션 처리
    strUnion(psFmt, puValue, pbForward, pnMax, pnMin)   // 문자열 채우기
    makeString(pnLength, pcChar)                        // 지정한 문자를 지정한 길이만큼 반복한 문자열 반환
    leftAlign(pnByte, psSrc)                            // 좌측정렬 문자열을 반환
    rightAlign(pnByte, psSrc)                           // 우측정렬 문자열을 반환

*/



/**
 * @constructor
 *
 * @param pdDate1st
 * @param pdDate2nd
 * @param pbCalcOnlyDay
 *
 * @description
 *  imeSpan class  : 두 날짜(Date Object)간 시간차를 계산
 * <pre>
 *   var dateCur  = new Date();
 *   var dateDest = new Date(2011, 9, 28);
 *   var tsDays = new TimeSpan(dateDest, dateCur, true);
 *   model.msgbox("남은 일수는 " + tsDay.getSpanDays() + "일 입니다.", "");
 *  </pre>
 */
var TimeSpan = function (pdDate1st, pdDate2nd, pbCalcOnlyDay) { // date1st As Date, date2nd As Date, bCalcOnlyDay As Boolean

    if (pbCalcOnlyDay) { //  date에서 시각부분을 배제하고 계산
        pdDate2nd.setHours(pdDate1st.getHours());
        pdDate2nd.setMinutes(pdDate1st.getMinutes());
        pdDate2nd.setSeconds(pdDate1st.getSeconds());
        pdDate2nd.setMilliseconds(pdDate1st.getMilliseconds());
    }

    var mnMilliSpan = Number(pdDate1st) - Number(pdDate2nd);

    /**
     * 날수차이 반환
     *
     * @returns {number}
     */
    this.getSpanDays = function () {
        return parseInt(mnMilliSpan / (1000 * 60 * 60 * 24));
    };

    /**
     * 시간차이 반환
     *
     * @returns {number}
     */
    this.getSpanHours = function () {
        return parseInt(mnMilliSpan / (1000 * 60 * 60));
    };

    /**
     * getSpanMinutes();
     * 분차이 반환
     */
    this.getSpanMinutes = function () {
        return parseInt(mnMilliSpan / (1000 * 60));
    };

    /**
     * getSpanSeconds();
     * 초차이 반환
     */
    this.getSpanSeconds = function () {
        return parseInt(mnMilliSpan / (1000));
    };

    /**
     * getSpanMilliseconds();
     * 1/1000초차이 반환
     */
    this.getSpanMilliseconds = function () {
        return parseInt(mnMilliSpan);
    };

};


/**
 * DateUtil
 * static class : 날짜관련 계산 및 변환 처리
 *
 * @constructor
 */
var DateUtil = {

    /**
     * 날짜형식체크
     * @param inputValue {String}    날짜 yyyymmdd
     * @returns {Boolean}
     */
    isDate: function (inputValue) {
        try{
            inputValue = inputValue.replace(/-/g,'');

            var yyyy = inputValue.substr(0,4);
            var mm = inputValue.substr(4,2);
            var dd = inputValue.substr(6,2);

            var v1 = true;
            var v2 = eval(mm) >= 1 && eval(mm) <= 12;

            var st_dd = 1;
            var ed_dd = 0;

            switch(eval(mm)){
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    ed_dd = 31;
                    break;
                case 4:
                case 6:
                case 9:
                case 11:
                    ed_dd = 30;
                    break;
                case 2: // 윤달은 생략
                    ed_dd = 29;
                    break;
            }

            var v3 = (eval(dd) >= st_dd && eval(dd) <= ed_dd) || dd == '';

            if( (v1 && v2 && v3) == false ){
                return false;
            }
        }catch(e){
            return false;
        }
        return true;
    } ,


    /**
     * 시간 체크
     *
     * @param inputValue  {String}   시간 (hhmm)
     * @returns {Boolean}
     */
    isTime: function (inputValue) { // dateValue As Date, strPattern As String
        try{
            var hh = inputValue.substr(0,2);
            var mm = inputValue.substr(2,2);

            var v1 = eval(hh) >= 0 && eval(hh) < 31
            var v2 = eval(mm) >= 0 && eval(hh) < 60

            if((v1 && v2) == false){
                return false;
            }
        }catch(e){
            return false;
        }
        return true;
    } ,


/**
     * format(pdDate, psPattern);
     * 날짜를 지정한 패턴의 문자열로 반환(String) : Date.prototype.format 과 동일
     *
     * @param pdDate
     * @param psPattern
     * @returns {*}
     */
    format: function (pdDate, psPattern) { // dateValue As Date, strPattern As String
        return pdDate.format(psPattern);
    },

    /**
     * checkDateString(psYear, psMonth, psDay);
     * 올바른 날짜 문자열인지 체크
     *
     * @param psYear
     * @param psMonth
     * @param psDay
     * @returns {*}
     */
    checkDateString: function (psYear, psMonth, psDay) {
        return this.checkDate(Number(psYear), Number(psMonth), Number(psDay));
    },

    /**
     * checkDate(pnYear, pnMonth, pnDay);
     * 올바른 날짜인지 체크 : ex) Str
     *
     * @param pnYear
     * @param pnMonth
     * @param pnDay
     * @returns {boolean}
     */
    checkDate: function (pnYear, pnMonth, pnDay) {
        var vdDate = new Date(pnYear, pnMonth - 1, pnDay);
        return vdDate.getFullYear() == pnYear &&
            vdDate.getMonth() == pnMonth - 1 &&
            vdDate.getDate() == pnDay;
    },

    /**
     * toDate(psDateTime, psPattern);
     * 날짜 문자열을 Date형으로 변환후 반환(Date) : ex) DateUtil.toDate("2011-09-09","YYYY-MM-DD");
     *
     * @param psDateTime
     * @param psPattern
     * @returns {Date}
     */
    toDate: function (psDateTime, psPattern) {
        var vdDate = new Date();
        var vnIdx, vnCnt;

        var vsaFmt = ["Y", "M", "D", "H", "m", "s", "S"];
        var vnFmtLen = vsaFmt.length;

        if(psPattern == null ){
            psPattern ="YYYYMMDD"  ;
        }

        var vnPtnLen = psPattern.length;
        var vnaNums = [vdDate.getFullYear(), vdDate.getMonth() + 1, vdDate.getDate(), vdDate.getHours(), vdDate.getMinutes(), vdDate.getSeconds(), vdDate.getMilliseconds()];

        for (var i = 0; i < vnFmtLen; i++) {
            vnIdx = psPattern.indexOf(vsaFmt[i]);
            if (vnIdx != -1) {
                vnCnt = 1;
                for (var j = vnIdx + 1; j < vnPtnLen; j++) {
                    if (psPattern.charAt(j) != vsaFmt[i]) {
                        break;
                    }
                    vnCnt++;
                }
                vnaNums[i] = Number(psDateTime.substring(vnIdx, vnIdx + vnCnt));
            }
        }

        if (vnaNums[0] < 1900) { // 년도는 검증
            if (vnaNums[0] <= vdDate.getFullYear() % 100) {
                vnaNums[0] += vdDate.getFullYear() - (vdDate.getFullYear() % 100);
            } else if (vnaNums[0] < 100) {
                vnaNums[0] += 1900;
            } else {
                vnaNums[0] = 1900;
            }
        }

        return new Date(vnaNums[0], vnaNums[1] - 1, vnaNums[2], vnaNums[3], vnaNums[4], vnaNums[5], vnaNums[6]);
    },

    /**
     * getMonthLastDate(pnYear, pnMonth);
     * 해당월의 말일 반환 (int)
     *
     * @param pnYear
     * @param pnMonth
     * @returns {number}
     *
     * @example
     *  var voDate = new Date().format("YYYYMMDD");
     *  DateUtil.getMonthLastDate(voDate.substring(0,4),  voDate.substring(4,6)));
     */
    getMonthLastDate: function (pnYear, pnMonth) {
        var vdDate = new Date(Number(pnYear), Number(pnMonth), 0, 1, 0, 0);
        return vdDate.getDate();
    },

    /**
     * getPrevMonthLastDate(pdBaseDate);
     * 지정한 날짜의 전월 말일 반환(int)
     *
     * @param pdBaseDate
     * @returns {number}
     */
    getPrevMonthLastDate: function (pdBaseDate) { // pdBaseDate As Date
        var vdPrevLast = new Date(pdBaseDate.getFullYear(), pdBaseDate.getMonth(), 0, 1, 0, 0);
        return vdPrevLast.getDate();
    },

    /**
     * getDaySpan(pdDate1st, pdDate2nd);
     * 두 날짜간 일수 반환(int)
     *
     * @param pdDate1st
     * @param pdDate2nd
     * @returns {number}
     *
     * @example
     * DateUtil.getDaySpan(DateUtil.toDate(vsYmdTo_t, "YYYYMMDD"), vdStDate);
     */
    getDaySpan: function (pdDate1st, pdDate2nd) { // pdDate1st As Date, pdDate2nd As Date
        var vts = new TimeSpan(pdDate1st, pdDate2nd, true);
        return vts.getSpanDays();
    }

};


/**
 * ValueUtil
 * Value 체크 및 형 변환
 *
 * @constructor
 */
var ValueUtil = {

    /**
     * isNull(puValue);
     * Null 여부 체크
     */
    isNull: function (puValue) {
        return (this.fixNull(puValue) == "");
    },

    /**
     * isNumber(psValue);
     * Number형 value인지 체크 : ex) ValueUtil.isNumber("1234.56") == true
     */
    isNumber: function (psValue) {
        var vnNum = Number(psValue);
        return isNaN(vnNum) == false;
    },

    /**
     * fixNull(puValue);
     * null이거나 정의되지 않은경우  반환
     *
     * @param puValue   : 검증값
     * @param returnVal : puValue 가 null 일 경우 리턴값( 정의되지 않을 경우 '' 리턴)
     * @returns {string}
     */
    fixNull: function (puValue, returnVal) {
        var vsType = typeof (puValue);
        if (vsType == "string" || (vsType == "object" && puValue instanceof String)) {
            puValue = puValue.trim();
        }
        var rVal = "" ;
        if(puValue == null || puValue == "null" || puValue == "undefined"){
            if(returnVal == null || returnVal == "null" || returnVal == "undefined"){
                rVal = "" ;
            }else{
                rVal  = returnVal ;
            }
        }
        return (puValue == null || puValue == "null" || puValue == "undefined") ? rVal : String(puValue);
    },

    /**
     * fixBoolean(puValue);
     * Boolean형으로 반환
     */
    fixBoolean: function (puValue) {
        if (typeof (puValue) == "boolean" || puValue instanceof Boolean) {
            return puValue;
        }
        if (typeof (puValue) == "number" || puValue instanceof Number) {
            return puValue != 0;
        }
        return (this.fixNull(puValue).toUpperCase() == "TRUE");
    },

    /**
     * fixNumber(puValue);
     * Number형으로 반환
     */
    fixNumber: function (puValue) {
        if (typeof (puValue) == "number" || puValue instanceof Number) {
            return puValue;
        }
        var vnNum = Number(this.fixNull(puValue));
        return isNaN(vnNum) ? 0 : vnNum;
    },

    /**
     * 소수점 자르기
     *
     * int  pnS    full 소수점
     * int  pnPos  full 소수점
     */
    trunc: function (pnS, pnPos) {
        var vsT = "0.0";
        var vsTail = "";
        var vaStrs = ("" + pnS).split(".");

        if (vaStrs.length > 1) {
            if (vaStrs[1].length >= pnPos)
                vsT = vaStrs[0] + "." + vaStrs[1].substring(0, pnPos);
            else {
                for (var i = 0; i < pnPos - vaStrs[1].length; i++) {
                    vsTail += "0";
                }

                vsT = vaStrs[0] + "." + vaStrs[1] + vsTail;
            }
        } else {
            for (var i = 0; i < pnPos; i++) {
                vsTail += "0";
            }

            vsT = vaStrs[0] + "." + vsTail;
        }

        return Number(vsT);
    }

};


/**
 * MsgBox
 * 메세지박스
 * @constructor
 */
var MsgBox = {

    /**
     * MsgBox Return Value Constants
     */
    IDOK: 1,
    IDCANCEL: 2,
    IDABORT: 3,
    IDRETRY: 4,
    IDIGNORE: 5,
    IDYES: 6,
    IDNO: 7,

    /**
     * MsgBox Type Constants
     */
    MB_OK: "ok",
    MB_OKCANCEL: "okcancel",
    MB_ABORTRETRYIGNORE: "abortretryignore",
    MB_YESNOCANCEL: "yesnocancel",
    MB_YESNO: "yesno",
    MB_RETRYCANCEL: "retrycancel",

    /**
     * Default Title
     */
    msDefaultTitle: null,

    /**
     * setDefaultTitle(psTitle);
     * 모든 메세지박스에 적용할 제목 설정, 최초 한번만 설정하면 유지됨 : ex) MsgBox.setDefaultTitle("우편접수시스템");
     */
    setDefaultTitle: function (psTitle) {
        this.msDefaultTitle = psTitle;
    },

    /**
     * show(psMsg, psType, psTitle);
     * 기본 메세지박스 : ex) MsgBox.show("안녕하세요!"); -> 기본 확인버튼(ok)을 가진 메세지박스 출력
     */
    show: function (psMsg, psType, psTitle) {

        if (psType == null) {
            psType = this.MB_OK;
        }
        //메시지 박스 타이틀 변경
        psTitle = "알림";

        if (psTitle) {
            if (psType == this.MB_OK) {
                return alert(psMsg);
            } else if (psType == this.MB_OKCANCEL) {
                return confirm(psMsg) ? this.IDOK : this.IDCANCEL;
            } else if (psType == this.MB_YESNO) {
                return confirm(psMsg) ? this.IDYES : this.IDNO;
            } else {
                return confirm(psMsg);
            }
            //return model.msgboxT(psMsg, psTitle, psType);
        } else if (this.msDefaultTitle) {
            return model.msgboxT(psMsg, this.msDefaultTitle, psType);
        } else {
            return model.msgbox(psMsg, psType);
        }
    },

    /**
     * showOkCancel(psMsg, psTitle);
     * 확인/취소 메세지박스 : ex) if (MsgBox.showOkCancel("진행하시겠습니까?") == MsgBox.IDCANCEL) return;
     */
    showOkCancel: function (psMsg, psTitle) {
        return this.show(psMsg, this.MB_OKCANCEL, psTitle);
    },

    /**
     * showAbort(psMsg, psTitle);
     * 중단/다시시도/무시 메세지박스 : ex) if (MsgBox.showAbort("잘못된 입력입니다.") == MsgBox.IDABORT) return;
     */
    showAbort: function (psMsg, psTitle) {
        return this.show(psMsg, this.MB_ABORTRETRYIGNORE, psTitle);
    },

    /**
     * showYesNoCancel(psMsg, psTitle);
     * 예/아니오/취소 메세지박스 : ex) if (MsgBox.showYesNoCancel("종료 전에 저장하시겠습니까?") == MsgBox.IDNO) return;
     */
    showYesNoCancel: function (psMsg, psTitle) {
        return this.show(psMsg, this.MB_YESNOCANCEL, psTitle);
    },

    /**
     * showYesNo(psMsg, psTitle);
     * 예/아니오 메세지박스 : ex) if (MsgBox.showYesNo("전송하시겠습니까?") == MsgBox.IDYES)
     */
    showYesNo: function (psMsg, psTitle) {
        return this.show(psMsg, this.MB_YESNO, psTitle);
    },

    /**
     * showRetry(psMsg, psTitle);
     * 다시시도/취소 메세지박스
     */
    showRetry: function (psMsg, psTitle) {
        return this.show(psMsg, this.MB_RETRYCANCEL, psTitle);
    }

};


/**
 * ComMsg
 * Common Message Library
 *
 * @constructor
 */
var ComMsg = {

    /**
     * Information Messages
     */
    INF: {
          M001: "성공적으로 저장하였습니다."
        , M002: "성공적으로 등록하였습니다."
        , M003: "성공적으로 수정하였습니다."
        , M004: "성공적으로 삭제하였습니다."
        , M005: "@님 안녕하세요?"
        , M008: "관리자에게 문의하십시오."
        , M009: "성공적으로 출력되었습니다."
        , M010: "@을(를) 성공적으로 저장하였습니다."
        , M011: "@이(가) 삭제되었습니다."
        , M012: "@을(를) 성공적으로 생성하였습니다."
        , M013: "처리가 취소되었습니다."
        , M007: "유효합니다."
        , M015: "유효한 @입니다."
        , M016: "@이(가) 아닙니다."
    },

    /**
     * Confirm Messages
     */
    CRM: {
        M001: "저장하시겠습니까?"
        , M002: "등록하시겠습니까?"
        , M003: "수정하시겠습니까?"
        , M004: "삭제하시겠습니까?"
        , M005: "변경사항이 반영되지 않았습니다. 계속 하시겠습니까?"
        , M006: "이미 존재하는 @ 입니다. 추가하시겠습니까?"
        , M008: "@을(를) 삭제하시겠습니까?"
        , M009: "@을(를) 생성하시겠습니까?"
        , M010: "@을(를) 적용하시겠습니까?"
        , M011: "취소하시겠습니까?"
        , M013: "즉시 승인하시겠습니까?"
    },

    /**
     * Error Messages
     */
    ERR: {
          M001: "@은(는) 변경된 사항이 없습니다."
        , M002: "@은(는) 필수 입력 항목입니다."
        , M003: "해당되는 자료가 존재하지 않습니다."
        , M004: "@은(는) 공백없이 입력하십시오."
        , M005: "@은(는) @자리수만큼 입력하십시오."
        , M006: "@은(는) @부터 @사이로 입력하십시오."
        , M007: "@은(는) 숫자만을 입력하십시오."
        , M008: "@은(는) 문자만을 입력하십시오."
        , M009: "@은(는) 숫자와 문자만을 입력하십시오.(공백제외)"
        , M010: "@은(는) 숫자와 문자만을 입력하십시오.(공백포함)"
        , M011: "@은(는) @자 이상으로 입력하십시오."
        , M012: "@은(는) @자 이하로 입력하십시오."
        , M013: "@은(는) @ 이상으로 입력하십시오."
        , M014: "@은(는) @ 이하로 입력하십시오."
        , M015: "@은(는) 년도가 잘못되었습니다."
        , M016: "@은(는) 유효한 주민등록번호가 아닙니다."
        , M017: "@은(는) 유효한 사업자등록번호가 아닙니다."
        , M018: "@은(는) 유효한 날짜가 아닙니다."
        , M019: "@은(는) 월이 잘못되었습니다."
        , M020: "@은(는) 일이 잘못되었습니다."
        , M021: "@은(는) 시가 잘못되었습니다."
        , M022: "@은(는) 분이 잘못되었습니다."
        , M023: "@은(는) 초가 잘못되었습니다."
        , M025: "@은(는) @년 @월 @일 이후이어야 합니다."
        , M024: "@은(는) @년 @월 @일 이전이어야 합니다."
        , M026: "@은(는) '@' 형식이어야 합니다.\n  - # : 문자 혹은 숫자\n  - h, H : 한글(H는 공백포함)\n  - A, Z : 문자(Z는 공백포함)\n  - 0, 9 : 숫자(9는 공백포함)"
        , M027: "@은(는) @자리수만큼 입력하십시오. (한글은 @자리수)"
        , M028: "@은(는) @자 이상으로 입력하십시오. (한글은 @자 이상)"
        , M029: "@은(는) @자 이하로 입력하십시오. (한글은 @자 이하)"
        , M030: "@은(는) "
        , M031: "@의 @번째 데이터에서 "
        , M032: "@은(는) 중복될 수 없습니다."
        , M033: "@은(는) 다음 문자가 올 수 없습니다.\n@"
        , M034: "페이지 설정이 잘못되었습니다."
        , M035: "@페이지 이상은 출력할 수 없습니다"
        , M036: "@은(는) 다음 문자만 올 수 있습니다.\n@"
        , M037: "@은(는) 유효한 이메일 주소가 아닙니다."
        , M038: "유효한 @가 아닙니다."
        , M039: "시작일자를 종료일자 이전으로 선택[입력]하여 주십시오."
        , M040: "패스워드가 일치하지 않습니다."
        , M041: "@은(는) @할 수 없습니다."
        , M042: "@은(는) 변경된 사항이 있습니다. \n변경사항을 저장 후 @을(를) 수행하십시오."
        , M043: "유효하지 않는 @ 입니다.\n다시 입력하여주십시요"
        , M045: "시작범위는 종료범위보다 작아야 합니다. :@"
        , M046: "존재하지 않는 @입니다."
        , M047: "오류가 발생하였습니다.\n관리자에게 문의하십시오."
        , M048: "@은(는) @보다 작아야 합니다."
        , M049: "@이(가) 존재하지 않습니다."
        , M050: "오류가 발생하였습니다.\n처음부터 다시 시작하여 주십시오."
        , M051: "@을(를) 실패하였습니다."
        , M052: "해당조건의 @이(가) 존재하지 않습니다."
        , M053: "@이(가) 누락되었습니다."
        , M054: "@ 생성을 실패하였습니다."
        , M055: "@을(를) 확인하여 주십시오."
        , M056: "선택된 @이(가) 없습니다."
        , M057: "@은(는) @ 보다 큰 값으로 입력하십시오."
        , M058: "시작시간을 종료시간 이전으로 선택[입력]하여 주십시오."
        , M059: "@은(는) 정수부를 @자 이하로 입력하십시오."
        , M060: "@은(는) 소수부를 @자 이하로 입력하십시오."
    },

    /**
     * Warning Messages
     */
    WRN: {
          M001: "저장할 데이터가 존재하지 않습니다.\n먼저 @검색을 하십시오."
        , M002: "조회결과가 존재하지 않습니다."
        , M003: "@을(를) 입력하십시오."
        , M004: "삭제할 @이(가) 존재하지 않습니다."
        , M005: "'+' 버튼을 누른 후 입력하십시오."
        , M006: "'+'버튼을 누르신 후 @을(를) 입력하십시오."
        , M007: "@을(를) 선택하십시오."
        , M008: "검색한 데이터가 존재하지 않습니다.\n먼저 @검색을 하십시오."
        , M009: "출력할 @이(가) 없습니다."
        , M010: "@ 버튼을 이용하십시오."
        , M011: "이미 존재하는 @입니다."
        , M012: "@이(가) 반영되지 않았습니다."
        , M013: "데이터를 전송 중 오류가 발생하였습니다.\n확인 후 다시 시도해주시기 바랍니다."
    },

    /**
     * _verifyID(psID, psMsg);
     */
    _verifyID: function (psID, psMsg) {
        if (ValueUtil.isNull(psMsg)) {
            throw new InvalidArgumentException("[" + psID + "]는 존재하지 않습니다.");
        }
    },

    /**
     * getMsg(psMsg, psaArgs);
     */
    getMsg: function (psMsg, psaArgs) {
        if (psMsg == null || psMsg == "") return "";
        if (psaArgs == null) {
            return psMsg;
        }

        var vnIndex = 0;
        var vnCount = 0;
        while ((vnIndex = psMsg.indexOf("@", vnIndex)) != -1) {
            if (psaArgs[vnCount] == null) psaArgs[vnCount] = "";
            psMsg = psMsg.substr(0, vnIndex) + String(psaArgs[vnCount]) + psMsg.substring(vnIndex + 1);
            vnIndex = vnIndex + String(psaArgs[vnCount++]).length;
        }
        return psMsg;
    },

    /**
     * alert(psMsg, psaArgs);
     */
    alert: function (psMsg, psaArgs) {
        alert(this.getMsg(psMsg, psaArgs));
    },

    /**
     * info(psID, psaArgs);
     * ex) ComMsg.info("M001"); -> ComMsg.INF.M001 : 성공적으로 저장하였습니다.
     */
    info: function (psID, psaArgs) {
        this._verifyID(psID, this.INF[psID]);
        this.alert(this.INF[psID], psaArgs);
    },

    /**
     * confirm(psID, psaArgs, psMsgBoxType);
     * ex) ComMsg.confirm("M001"); -> ComMsg.WRN.M001 : 저장하시겠습니까?
     */

    confirm: function (psID, psaArgs, psMsgBoxType) {
        this._verifyID(psID, this.CRM[psID]);
        if (ValueUtil.isNull(psMsgBoxType)) psMsgBoxType = MsgBox.MB_OKCANCEL;
        return MsgBox.show(this.getMsg(this.CRM[psID], psaArgs), psMsgBoxType);
    },


    /**
     * error(psID, psaArgs);
     * ex) ComMsg.error("M001", ["우편번호"]); -> ComMsg.ERR.M001 : 우편번호은(는) 변경된 사항이 없습니다.
     */
    error: function (psID, psaArgs) {
        this._verifyID(psID, this.ERR[psID]);
        this.alert(this.ERR[psID], psaArgs);
    },

    /**
     * warn(psID, psaArgs);
     * ex) ComMsg.warn("M003", ["발송인"]); -> ComMsg.WRN.M003 : 발송인을(를) 입력하십시오.
     */
    warn: function (psID, psaArgs) {
        this._verifyID(psID, this.WRN[psID]);
        this.alert(this.WRN[psID], psaArgs);
    }

};


/**
 * StrFmtUtil
 * 문자열 형태 변환
 *
 * @constructor
 */
var StrFmtUtil = {

    /**
     * getFmtVal(psType, psFormat, psValue);
     * 인자로 넘겨준 value를 지정된 형식(Xtm Input컨트롤의 Format)을 적용해서 리턴 한다.
     * ex) StrFmtUtil.getFmtVal("num","#,###.00","12345678");
     */
    getFmtVal: function (psType, psFormat, psValue) {
        var rtnStr = "";
        if (psType == "num") {
            rtnStr = Common.rateFomatter2(psValue, psFormat.substr(psFormat.indexOf(".") + 1).length);
        } else if (psType == "date") {
            psFormat = psFormat.replaceAll('Y', 'y');
            psFormat = psFormat.replaceAll('m', 'M');
            psFormat = psFormat.replaceAll('D', 'd');

            var dateObj = WebSquare.date.parseDate(psValue);
            rtnStr = WebSquare.date.getFormattedDate(dateObj, psFormat);

        } else {
            psType
        }
        return rtnStr;
    },

    /**
     * toNumFormat(psValue);
     * 숫자를 천단위 ,구분 문자열로 반환 : ex) StrFmtUtil.toNumFormat("-1234567.89") == "-1,234,567.89"
     */
    toNumFormat: function (psValue) {
       if((psValue||'') == "") return 0 ;
       return psValue.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    },

    /**
     * toNumUnFormat(psValue);
     * 순수숫자만 포함하는 문자열로 반환(음수기호포함) : ex) StrFmtUtil.toNumUnFormat("-1,234.56") == "-1234.56"
     */
    toNumUnFormat: function (psValue) {
        var vbMinus = psValue.indexOf("-") == 0;
        psValue = psValue.replace(/[^\d.]/g, "");
        return vbMinus ? "-" + psValue : psValue;
    },

    /**
     * toTimeFormat(psValue);
     * 시각표현 문자열 HH:mm로 반환 : ex) IN "123" -> "12:03", IN "1234" -> "12:34", IN "256" -> "02:56"
     */
    toTimeFormat: function (psValue) {
        var vsaFmt = ["0", "0", ":", "0", "0"];
        psValue = this.toDateUnFormat(psValue);
        var vsaNums = psValue.split("");

        switch (psValue.length) {
            case 0 :
                return "";
            case 1 :
                vsaFmt[1] = vsaNums[0];
                break;
            case 2 :
                if (psValue < "24") {
                    vsaFmt[0] = vsaNums[0];
                    vsaFmt[1] = vsaNums[1];
                } else {
                    vsaFmt[1] = vsaNums[0];
                    vsaFmt[4] = vsaNums[1];
                }
                break;
            case 3 :
                if (psValue.substring(0, 2) < "24") {
                    vsaFmt[0] = vsaNums[0];
                    vsaFmt[1] = vsaNums[1];
                    vsaFmt[4] = vsaNums[2];
                } else {
                    vsaFmt[1] = vsaNums[0];
                    vsaFmt[3] = vsaNums[1];
                    vsaFmt[4] = vsaNums[2];

                    if (vsaFmt[3] + vsaFmt[4] > "59") {
                        vsaFmt[3] = "5";
                        vsaFmt[4] = "9";
                    }
                }
                break;
            case 4 :
                vsaFmt[0] = vsaNums[0];
                vsaFmt[1] = vsaNums[1];
                vsaFmt[3] = vsaNums[2];
                vsaFmt[4] = vsaNums[3];

                if (vsaFmt[1] + vsaFmt[2] > "23") {
                    vsaFmt[1] = "2";
                    vsaFmt[2] = "3";
                }

                if (vsaFmt[3] + vsaFmt[4] > "59") {
                    vsaFmt[3] = "5";
                    vsaFmt[4] = "9";
                }
                break;
        }
        return vsaFmt.join("");
    },

    /**
     * toDateFormat(psValue, psDelim);
     * YYYYMMDD문자열을 YYYY-MM-DD 형태로 반환 : ex) StrFmtUtil.toDateFormat("20111231") == "2011-12-31";
     */
    toDateFormat: function (psValue, psDelim) {
        var vdToday = new Date();

        var vnFormat = 1;
        var vsDelim = ValueUtil.isNull(psDelim) ? "-" : psDelim;

        var vsOrz = "";
        var vnOrz = 0;
        var vsRst = "";
        var vsYY = "";
        var vsMM = "";
        var vsDD = "";

        var vsTodayYY = this.strUnion("0000", vdToday.getFullYear().toString());
        var vsTodayMM = this.strUnion("00", (vdToday.getMonth() + 1).toString());
        var vsTodayDD = this.strUnion("00", vdToday.getDate().toString());

        vsOrz = this.toDateUnFormat(String(psValue));
        vnOrz = vsOrz.length;

        switch (vnOrz) {
            case 0:
                return "";
            case 2:
                vsYY = vsTodayYY;
                vsMM = "0" + vsOrz.substring(0, 1);
                vsDD = "0" + vsOrz.substring(1, 2);
                break;
            case 3:
                vsYY = vsTodayYY;
                if (vsOrz.substring(0, 2) < "13") {
                    vsMM = vsOrz.substring(0, 2);
                    vsDD = "0" + vsOrz.substring(2, 3);
                } else {
                    vsMM = "0" + vsOrz.substring(0, 1);
                    vsDD = vsOrz.substring(1, 3);
                }
                break;
            case 4:
                vsYY = vsTodayYY;
                vsMM = vsOrz.substring(0, 2);
                vsDD = vsOrz.substring(2, 4);
                break;
            case 6:
                if (eval(vsOrz.substring(0, 2)) - eval(vsTodayYY.substring(2, 4)) > 0) {
                    vsYY = "19" + vsOrz.substring(0, 2);
                } else {
                    vsYY = vsTodayYY.substring(0, 2) + vsOrz.substring(0, 2);
                }
                vsMM = vsOrz.substring(2, 4);
                vsDD = vsOrz.substring(4, 6);
                break;
            case 7:
                vsYY = vsOrz.substring(0, 4);
                if (vsOrz.substring(4, 6) < "13") {
                    vsMM = vsOrz.substring(4, 6);
                    vsDD = "0" + vsOrz.substring(6, 7);
                } else {
                    vsMM = "0" + vsOrz.substring(4, 5);
                    vsDD = vsOrz.substring(5, 7);
                }
                break;
            case 8:
                vsYY = vsOrz.substring(0, 4);
                vsMM = vsOrz.substring(4, 6);
                vsDD = vsOrz.substring(6, 8);
                break;
            default:
                vsYY = vsTodayYY;
                vsMM = vsTodayMM;
                vsDD = vsTodayDD;
                break;
        }

        if (vsYY < "1900") {
            vsYY = vsTodayYY;
        }

        if (vsMM < "01") {
            vsMM = "01";
        } else if (vsMM > "12") {
            vsMM = "12";
        }

        if (vsDD < "01") {
            vsDD = "01";
        } else {
            var vdLastDate = new Date(Number(vsYY), Number(vsMM), 0);
            var vnLastDay = vdLastDate.getDate();
            if (Number(vsDD) > vnLastDay) {
                vsDD = vnLastDay.toString();
            }
        }

        if (DateUtil.checkDateString(vsYY, vsMM, vsDD) == false) {
            // 이런 경우는 어떤 경우일까?
        }

        return (vsYY + vsDelim + vsMM + vsDelim + vsDD);
    },

    /**
     * toDateUnFormat(psValue);
     * Undo toDateFormat
     */
    toDateUnFormat: function (psValue) {
        return psValue.replace(/[^\d.]/g, "");
    },

    /**
     * toPostNumFormat(psValue);
     * 우편번호 000-000 형태로 반환 : ex) StrFmtUtil.toPostNumFormat("12345") == "123-450"
     */
    toPostNumFormat: function (psValue) {
        psValue = this.strUnion("000000", this.toPostNumUnFormat(psValue), true);
        return psValue.substring(0, 3) + "-" + psValue.substring(3);
    },

    /**
     * toPostNumUnFormat(psValue);
     * Undo toPostNumFormat
     */
    toPostNumUnFormat: function (psValue) {
        return this.toDateUnFormat(psValue);
    },

    /**
     * addQuotation(psValue);
     * 문자열 싱글쿼테이션 처리 : ex) StrFmtUtil.addQuotation("홍길동") == "'홍길동'"
     */
    addQuotation: function (psValue) {
        return "'" + ValueUtil.fixNull(psValue) + "'";
    },

    /**
     * strUnion(psFmt, puValue, pbForward, pnMax, pnMin);
     * 문자열 오버랩 : ex) StrFmtUtil.strUnion("0000", "13", false, 12, 1) == "0012"
     */
    strUnion: function (psFmt, puValue, pbForward, pnMax, pnMin) {

        var vsValue = ValueUtil.fixNull(puValue);

        var vsaFmt = psFmt.split("");

        if (pnMax && Number(vsValue) > pnMax) {
            vsValue = pnMax.toString();
        }
        if (pnMin && Number(vsValue) < pnMin) {
            vsValue = pnMin.toString();
        }

        var vnFmtLen = vsaFmt.length;
        var vnValLen = vsValue.length;

        if (pbForward) {
            for (var i = 0; i < vnFmtLen && i < vnValLen; i++) {
                vsaFmt[i] = vsValue.charAt(i);
            }
        } else {
            for (var i = vnFmtLen - 1, j = vnValLen - 1; i >= 0 && j >= 0; i--, j--) {
                vsaFmt[i] = vsValue.charAt(j);
            }
        }

        return vsaFmt.join("");
    },

    /**
     * makeString(pnLength, pcChar);
     * 지정한 문자를 지정한 길이만큼 반복한 문자열 반환
     */
    makeString: function (pnLength, pcChar) {
        var vsStr = "";
        while (pnLength-- > 0) {
            vsStr += pcChar;
        }
        return vsStr;
    },

    /**
     * leftAlign(pnByte, psSrc);
     * 원시 문자열 ( srcStr ) 에  dummy 문자열을 우측에 더하여 size 만큼의 포맷에 맞추어진 좌측정렬 문자열을 반환한다.
     */
    leftAlign: function (pnByte, psSrc) {
        var vnSrcByte = psSrc.getByteLength();
        if (pnByte <= vnSrcByte) return psSrc;
        return psSrc + this.makeString(pnByte - vnSrcByte, ' ');
    },

    /**
     * rightAlign(pnByte, psSrc);
     * 원시 문자열( srcStr ) 에  dummy 문자열을 좌측에 더하여 size 만큼의 포맷에 맞추어진 우측정렬 문자열을 반환한다.
     */
    rightAlign: function (pnByte, psSrc) {
        var vnSrcByte = psSrc.getByteLength();
        if (pnByte <= vnSrcByte) return psSrc;
        return this.makeString(pnByte - vnSrcByte, ' ') + psSrc;
    }

};

//MapEx start
/*[
 @type	: normal
 @desc	: eXbuilder MapEx Class
]*/
var MapEx = function () {
    /*[
     @type		: normal
     @desc		: Map 내부에서 사용하는 Array 객체
    ]*/
    this.moEntry = [];

    /*[
     @type		: normal
     @desc		: Map 아이템 개수를 count 하는 변수
    ]*/
    this.mnLength = 0;
};

/*[
@type		: normal
@return 	: boolean
@desc		: 아이템이 있는지 없는지 검사한후 결과를 반환합니다.
]*/
MapEx.prototype.isEmpty = function () {
    return this.mnLength == 0 ? true : false;
};

/*[
@return	: boolean
@parameter
{
	 !psKey : 조사할 키값
}
@desc		: 해당 키값이 Map 에 존재하는지 검사하여 반환합니다.
]*/
MapEx.prototype.isExistKey = function (psKey) {
    return this.moEntry[psKey] == null ? false : true;
};

/*[
@type		: normal
@return	: boolean
@parameter
{
	 !psKey 	: 키값
	 !psValue 	: 값
}
@desc		: map 에 아이템을 추가합니다. 만약 같은 키값을 추가하면 이전 값은 지워지고 새로운 값으로 대체됩니다.
]*/
MapEx.prototype.put = function (psKey, psValue) {
    if (this.isExistKey(psKey) == false)
        this.mnLength++;

    var pair = [];

    pair["key"] = psKey;
    pair["value"] = psValue;

    this.moEntry[psKey] = pair;
};

/*[
@type		: normal
@return 	: object
@parameter
{
	 !psKey	: 반환받을 아이템의 키값
}
@desc 		: 키값에 해당하는 값을 반환합니다. 키에 해당하는 값이 없을 경우 null 을 리턴합니다.
]*/
MapEx.prototype.get = function (psKey) {
    if (this.isExistKey(psKey) == false) {
        return null;
    } else {
        return this.moEntry[psKey].value;
    }
};

/*[
@type		: normal
@return 	: boolean
@parameter
{
	 !psKey : 삭제할 아이템의 키값
}
@desc		: map 에서 해당 키값의 아이템을 삭제합니다.
]*/
MapEx.prototype.remove = function (psKey) {
    this.moEntry[psKey] = null;

    if (this.mnLength > 0)
        this.mnLength--;
    else
        return false;

    return true;
};

/*[
@type		: normal
@return	: object
@desc		: Map 의 Iterator 객체를 반환합니다. (Iterator는 첫번째 객체를 선택하고 있습니다.)
]*/
MapEx.prototype.iterator = function () {
    return new XtmIterator(this.moEntry);
};

/*[
@type		: normal
@return	: null
@desc		: map 을 초기화 합니다.
]*/
MapEx.prototype.clear = function () {
    this.moEntry = null;
    this.moEntry = [];
    this.mnLength = 0;
};
//MapEx end


/**
 * @constructor
 *
 * @param poPage
 * @param psInstancePath
 * @constructor
 */
var Instance = function (poPage, psInstancePath) {

    /**
     * Page
     */
    var moPage = poPage;

    var vsInstancePath = ValueUtil.fixNull(psInstancePath);


    /**
     * getValue(psName[, psFilter]);
     * 지정한 노드이름과 일치하는 노드의 값을 반환
     *
     * String   psName    값을 얻어올 노드명
     * String   psFilter  얻을 노드에 조건 세팅(생략가능)
     *
     * @desc
     * getValue("tomato");                            'tomato' node 값 반환
     * getValue("tomato", "child::name = 'system'");  'name' 노드의 값이 'system'인 'tomato' node 값 반환
     */
    this.getValue = function (psName, psFilter) {
        /* node -> /node */
        var vsName = psName.startsWith("/") ? psName : "/" + psName;
        var vsFilter = ValueUtil.fixNull(psFilter);
        vsFilter = vsFilter == "" ? vsFilter : "[" + vsFilter + "]";

        return WebSquare.ModelUtil.getInstanceValue(this.getInstancePath() + vsFilter + vsName);
    };

    /**
     * setValue(psName, puValue[, psFilter]);
     * 지정한 노드이름과 일치하는 노드에 지정한 값을 넣는다.
     *
     * String   psName    세팅할 노드명
     * String   puValue   세팅할 값
     * String   psFilter  세팅할 노드에 조건 세팅(생략가능)
     *
     * @desc
     * setValue("tomato", "토마토");                            'tomato' node '토마토' 세팅
     * setValue("tomato", "토마토", "child::name = 'system'");  'name' 노드의 값이 'system'인 'tomato' node에 '토마토' 세팅
     */
    this.setValue = function (psName, puValue, psFilter) {
        /* node -> /node */
        var vsName = psName.startsWith("/") ? psName : "/" + psName;
        var vuValue = puValue;
        var vsFilter = ValueUtil.fixNull(psFilter);
        vsFilter = vsFilter == "" ? vsFilter : "[" + vsFilter + "]";

        return WebSquare.ModelUtil.setInstanceValue(this.getInstancePath() + vsFilter + vsName, vuValue);
    };

    /**
     * Instance Path
     */
    var msInstancePath = vsInstancePath;


    /**
     * getInstancePath();
     * 인스턴스의 경로를 반환
     */
    this.getInstancePath = function () {
        return msInstancePath;
    };


    /**
     * resetInstance(pbRecursive);
     * 인스턴스의 값을 전부 초기화 한다.
     *
     * Boolean   pbRecursive   초기화 작업을 자식 Node포함 여부 선택(true : 포함, false : 미포함)
     */
    this.resetInstance = function (pbRecursive) {
        var vsInstanceId = "";
        var vsInstanceRef = "";
        if (vsInstancePath.startsWith("instance")) {
            var vsTmp = vsInstancePath.cut(0, vsInstancePath.indexOf("'") + 1);
            var vsTmp = vsTmp.cut(vsTmp.indexOf("'"), vsTmp.length + vsTmp.indexOf("'"));
            vsInstanceId = vsTmp;
            var vsTmpInstancePath = this.getInstancePath();
            vsInstanceRef = vsTmpInstancePath.substr(vsTmpInstancePath.indexOf(")") + 1);
        } else {
            vsInstanceRef = this.getInstancePath();
        }

        //xpath의 자식노드 명을 분리


        var vsChild = "";
        var vnStPos = vsInstanceRef.lastIndexOf("/");

        if (vnStPos > 0) {
            vsParent = vsInstanceRef.substring(0, vnStPos);
            vsChild = vsInstanceRef.substring(vnStPos + 1);
        } else {
            vsParent = vsInstanceRef;
        }

        //alert("vsParent:" + vsParent + "   vsChild:" + vsChild);

        Common.resetInstance(vsParent, pbRecursive, vsChild);
    };


    /**
     * addNode(psNodeName, psNodeValue, psNodeType);
     * 지정한 노드를 추가한다.
     *
     * String   psNodeName    생성될 Node의 이름
     * String   psNodeValue   생성될 Node에 들어갈 Value.
     * String   psNodeType    생성될 Node의 Type(Element 또는 Attribute)
     */
    this.addNode = function (psNodeName, psNodeValue, psNodeType) {
        //xml특수문자 치환
        psNodeValue = psNodeValue.replaceAll("<", "&lt;");
        psNodeValue = psNodeValue.replaceAll(">", "&gt;");
        psNodeValue = psNodeValue.replaceAll("&", "&amp;");
        psNodeValue = psNodeValue.replaceAll("'", "&apos;");
        psNodeValue = psNodeValue.replaceAll('"', "&quot;");

        var after = "<" + psNodeName + ">" + psNodeValue + "</" + psNodeName + ">";


        //임시 인스턴스 생성
        WebSquare.ModelUtil.setInstanceNode(WebSquare.xml.parse(after), "instanceTemporaryForAddNode");
        //add
        WebSquare.ModelUtil.copyChildrenNodes("instanceTemporaryForAddNode", this.getInstancePath(), "overwrite");
        //임시 인스턴스 제거
        WebSquare.ModelUtil.removeInstanceNode("instanceTemporaryForAddNode");

        //WebSquare.xml.appendChild(node1, node2);
    };


    /**
     * addNode(psNodeName, psNodeValue, psNodeType);
     * 지정한 노드를 추가한다.
     *
     * String   psNodeName    생성될 Node의 이름
     * String   psNodeValue   생성될 Node에 들어갈 Value.
     * String   psNodeType    생성될 Node의 Type(Element 또는 Attribute)
     */
    this.appendNode = function (psNodeName, psNodeValue, psNodeType) {
        //xml특수문자 치환
        psNodeValue = psNodeValue.replaceAll("<", "&lt;");
        psNodeValue = psNodeValue.replaceAll(">", "&gt;");
        psNodeValue = psNodeValue.replaceAll("&", "&amp;");
        psNodeValue = psNodeValue.replaceAll("'", "&apos;");
        psNodeValue = psNodeValue.replaceAll('"', "&quot;");


        var after = "<" + psNodeName + ">" + psNodeValue + "</" + psNodeName + ">";
        //임시 인스턴스 생성
        WebSquare.ModelUtil.setInstanceNode(WebSquare.xml.parse(after), "instanceTemporaryForAddNode");
        //add
        WebSquare.ModelUtil.copyChildrenNodes("instanceTemporaryForAddNode", this.getInstancePath(), "append");
        //임시 인스턴스 제거
        WebSquare.ModelUtil.removeInstanceNode("instanceTemporaryForAddNode");

        //WebSquare.xml.appendChild(node1, node2);
    };

    /**
     * deleteNode(psNode, psFilter);
     * 지정한 노드와 일치하는 자식 노드를 반환
     *
     * String   psNode     삭제할 Node의 이름
     * String   psFilter   삭제할 Node 중 filter로 조건문
     *
     * @desc
     * deleteNode();                                      해당 인스턴스 객체 전부 삭제
     * deleteNode("tomato");                              'tomato' node 만 삭제
     * deleteNode("tomato", "child::name = 'system'");    'tomato' node 삭제 시 조건을 걸어 'name' 노드의 값이 'system'인 노드 삭제
     */
    this.deleteNode = function (psNode, psFilter) {
        psNode = ValueUtil.fixNull(psNode);
        psFilter = ValueUtil.fixNull(psFilter);
        if (psNode == "") WebSquare.ModelUtil.removeInstanceNodes(this.getInstancePath());
        else if (psFilter == "") WebSquare.ModelUtil.removeInstanceNodes(this.getInstancePath() + "/" + psNode);
        else WebSquare.ModelUtil.removeInstanceNodes(this.getInstancePath() + "[" + psFilter + "]" + "/" + psNode);
    };

    /**
     * getNodeValue();
     * 인스턴스 노드의 값을 반환
     */
    this.getNodeValue = function () {
        return WebSquare.ModelUtil.getInstanceValue(this.getInstancePath());
    };

    /**
     * setNodeValue(puValue);
     * 인스턴스 노드에 지정한 값을 넣는다.
     *
     * String   puValue   세팅할 값
     */
    this.setNodeValue = function (puValue) {
        return WebSquare.ModelUtil.setInstanceValue(this.getInstancePath(), puValue);
    };


};




/**
 * @module String
 */

/**
 * @function
 * startsWith
 *
 * @description
 * String.startsWith(psWith);
 * 지정한 문자열로 시작하는지 판단
 *
 * @param psWith
 * @returns {boolean}
 */
String.prototype.startsWith = function (psWith) {
    return (this.indexOf(psWith) == 0);
};


/**
 * @function
 * endsWith
 *
 * @description
 * String endsWith(psWith);
 * 지정한 문자열로 끝나는지 판단
 *
 * @param psWith
 * @returns {boolean}
 */
String.prototype.endsWith = function (psWith) {
    var vnIdx = this.lastIndexOf(psWith);
    return vnIdx != -1 && vnIdx == (this.length - psWith.length);
};

/**
 * @function
 * isEmpty
 *
 * @description
 * String isEmpty();
 * 빈 문자열인지 판단
 *
 * @returns {boolean}
 */
String.prototype.isEmpty = function () {
    return (this.length == 0);
};

/**
 * @function
 * trimRight
 *
 * @description
 * String trimRight(psTrim);
 * 지정한 문자열로 오른쪽 잘라내기, 미지정시 오른쪽 공백문자 제거
 * ex) "xtmTest.xtm".trimRight(".xtm") == "xtmTest";  "test  ".trimRight() == "test";
 *
 * @param psTrim
 * @returns {string|String|*}
 */
String.prototype.trimRight = function (psTrim) {
    if (psTrim == null) {
        return this.replace(/(\s*$)/g, "");
    }
    var vnIdx = this.lastIndexOf(psTrim);
    return (vnIdx != -1 ? this.substring(0, vnIdx) : this);
};

/**
 * @function
 * trimLeft
 *
 * @description
 * String.trimLeft(psTrim);
 * 지정한 문자열로 왼쪽 잘라내기, 미지정시 왼쪽 공백문자 제거
 * ex) "xtmTest.xtm".trimLeft("xtm") == "Test.xtm";  "   test".trimLeft() == "test")
 *
 * @param psTrim
 * @returns {string|String|*}
 */
String.prototype.trimLeft = function (psTrim) {
    if (psTrim == null) {
        return this.replace(/(^\s*)/g, "");
    }
    var vnIdx = this.indexOf(psTrim);
    return (vnIdx == 0 ? this.substring(psTrim.length) : this);
};


/**
 * @function
 * getByteLength
 *
 * @description
 * 스트링의 자릿수를 Byte 단위로 환산하여 알려준다. 영문, 숫자는 1Byte이고 한글은 2Byte이다.(자/모 중에 하나만 있는 글자도 2Byte이다.)
 *
 * @returns {number}  :  스트링의 길이
 */
String.prototype.getByteLength = function () {
    var byteLength = 0;
    if (this.valueOf() == null || this.length == 0) {
        return 0;
    }
    var c;
    for (var i = 0; i < this.length; i++) {
        c = escape(this.charAt(i));
        if (c.length == 1) {
            byteLength++;
        } else if (c.indexOf("%u") != -1) {
            byteLength += 2;
        } else if (c.indexOf("%") != -1) {
            byteLength += c.length / 3;
        }
    }
    return byteLength;
};


/**
 * @function
 * simpleReplace
 *
 * @description
 *
 * 자바스크립트의 내장 객체인 String 객체에 simpleReplace 메소드를 추가한다. simpleReplace 메소드는
 * 스트링 내에 있는 특정 스트링을 다른 스트링으로 모두 변환한다. String 객체의 replace 메소드와 동일한
 * 기능을 하지만 간단한 스트링의 치환시에 보다 유용하게 사용할 수 있다.
 * <pre>
 *     var str = "abcde"
 *     str = str.simpleReplace("cd", "xx");
 * </pre>
 * 위의 예에서 str는 "abxxe"가 된다.
 *
 * @param oldStr required 바뀌어야 될 기존의 스트링
 * @param newStr required 바뀌어질 새로운 스트링
 * @returns {*} : : replaced String.
 */
String.prototype.simpleReplace = function (oldStr, newStr) {
    var rStr = oldStr;

    rStr = rStr.replace(/\\/g, "\\\\");
    rStr = rStr.replace(/\^/g, "\\^");
    rStr = rStr.replace(/\$/g, "\\$");
    rStr = rStr.replace(/\*/g, "\\*");
    rStr = rStr.replace(/\+/g, "\\+");
    rStr = rStr.replace(/\?/g, "\\?");
    rStr = rStr.replace(/\./g, "\\.");
    rStr = rStr.replace(/\(/g, "\\(");
    rStr = rStr.replace(/\)/g, "\\)");
    rStr = rStr.replace(/\|/g, "\\|");
    rStr = rStr.replace(/\,/g, "\\,");
    rStr = rStr.replace(/\{/g, "\\{");
    rStr = rStr.replace(/\}/g, "\\}");
    rStr = rStr.replace(/\[/g, "\\[");
    rStr = rStr.replace(/\]/g, "\\]");
    rStr = rStr.replace(/\-/g, "\\-");

    var re = new RegExp(rStr, "g");
    return this.replace(re, newStr);
};


/**
 * @function
 * trim
 *
 * @description
 * 자바스크립트의 내장 객체인 String 객체에 trim 메소드를 추가한다. trim 메소드는 스트링의 앞과 뒤에 있는 white space 를 제거한다.
 * <pre>
 *     var str = " abcde "
 *     str = str.trim();
 * </pre>
 * 위의 예에서 str는 "abede"가 된다.
 *
 * @return : trimed String.
 */
String.prototype.trim = function () {
    return this.replace(/(^\s*)|(\s*$)/g, "");
};


/**
 * @function
 * trimAll
 *
 * @description
 *  자바스크립트의 내장 객체인 String 객체에 trimAll 메소드를 추가한다. trim 메소드는 스트링 내에
 *  있는 white space 를 모두 제거한다.
 * <pre>
 *     var str = " abc de "
 *     str = str.trimAll();
 * </pre>
 * 위의 예에서 str는 "abcde"가 된다.
 * @return : trimed String.
 */
String.prototype.trimAll = function () {
    return this.replace(/\s*/g, "");
};


/**
 * @function
 * cut
 *
 * @description
 * 자바스크립트의 내장 객체인 String 객체에 cut 메소드를 추가한다. cut 메소드는 스트링의 특정 영역을 잘라낸다.
 * <pre>
 *     var str = "abcde"
 *     str = str.cut(2, 2);
 * </pre>
 * 위의 예에서 str는 "abe"가 된다.
 *
 * @param  : start  required start index to cut
 * @param  : length required length to cut
 * @return : cutted String.
 */
String.prototype.cut = function (start, length) {
    return this.substring(0, start) + this.substr(start + length);
};


/**
 * @function
 * insert
 *
 * @description
 * 자바스크립트의 내장 객체인 String 객체에 insert 메소드를 추가한다. insert 메소드는 스트링의 특정 영역에 주어진 스트링을 삽입한다.
 * <pre>
 *     var str = "abcde"
 *     str = str.insert(3, "xyz");
 * </pre>
 * 위의 예에서 str는 "abcxyzde"가 된다.
 * @sig    : start, length
 * @param  : index required 삽입할 위치. 해당 스트링의 index 바로 앞에 삽입된다. index는 0부터 시작.
 * @param  : str   required 삽입할 스트링.
 * @return : inserted String.
 */
String.prototype.insert = function (index, str) {
    return this.substring(0, index) + str + this.substr(index);
};


/**
 * @module Date
 */

/**
 *
 * CAL_INITIAL
 */
var CAL_INITIAL = {
    MONTH_IN_YEAR: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    SHORT_MONTH_IN_YEAR: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    DAY_IN_WEEK: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    SHORT_DAY_IN_WEEK: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
};

/**
 * @function
 * after
 *
 * @description
 * Date.after(years, months, dates, hours, miniutes, seconds, mss);
 * 지정된 날짜만큼 시간이 지난 후의 날짜를 반환
 *
 * @param years
 * @param months
 * @param dates
 * @param hours
 * @param miniutes
 * @param seconds
 * @param mss
 * @returns {Date}
 */
Date.prototype.after = function (years, months, dates, hours, miniutes, seconds, mss) {

    if (years == null) years = 0;
    if (months == null) months = 0;
    if (dates == null) dates = 0;
    if (hours == null) hours = 0;
    if (miniutes == null) miniutes = 0;
    if (seconds == null) seconds = 0;
    if (mss == null) mss = 0;
    return new Date(this.getFullYear() + Number(years),
        this.getMonth() + Number(months),
        this.getDate() + Number(dates),
        this.getHours() + Number(hours),
        this.getMinutes() + Number(miniutes),
        this.getSeconds() + Number(seconds),
        this.getMilliseconds() + Number(mss)
    );
};


/**
 * @function
 * afterMonth
 *
 * @description
 * Date.afterMonth(years, months);
 * 지정된 날짜만큼 시간이 지난 후의 날짜를 반환
 *
 * @param years
 * @param months
 * @returns {Date}
 */
Date.prototype.afterMonth = function (years, months) {

    if (years == null) years = 0;
    if (months == null) months = 0;
    return new Date(this.getFullYear() + Number(years),
        this.getMonth() + Number(months)
    );
};


/**
 * @function
 * before
 *
 * @description
 * Date.before(years, months, dates, hours, miniutes, seconds, mss);
 * 지정된 날짜만큼 이전의 날짜를 반환
 *
 * @param years
 * @param months
 * @param dates
 * @param hours
 * @param miniutes
 * @param seconds
 * @param mss
 * @returns {Date}
 */
Date.prototype.before = function (years, months, dates, hours, miniutes, seconds, mss) {
    if (years == null) {
        years = 0;
    }
    if (months == null) {
        months = 0;
    }
    if (dates == null) {
        dates = 0;
    }
    if (hours == null) {
        hours = 0;
    }
    if (miniutes == null) {
        miniutes = 0;
    }
    if (seconds == null) {
        seconds = 0;
    }
    if (mss == null) {
        mss = 0;
    }
    return new Date(this.getFullYear() - Number(years),
        this.getMonth() - Number(months),
        this.getDate() - Number(dates),
        this.getHours() - Number(hours),
        this.getMinutes() - Number(miniutes),
        this.getSeconds() - Number(seconds),
        this.getMilliseconds() - Number(mss)
    );
};


/**
 * @function
 * format
 *
 * @description
 *  자바스크립트의 내장 객체인 Date 객체에 format 메소드를 추가한다. format 메소드는 Date 객체가 가진 날짜를
 *           지정된 포멧의 스트링으로 변환한다.
 * <pre>
 *     var dateStr = new Date().format("YYYYMMDD");
 *
 *     참고 : Date 오브젝트 생성자들 - dateObj = new Date()
 *                                   - dateObj = new Date(dateVal)
 *                                   - dateObj = new Date(year, month, date[, hours[, minutes[, seconds[,ms]]]])
 * </pre>
 * 위의 예에서 오늘날짜가 2011년 9월 5일이라면 dateStr의 값은 "20110905"가 된다.
 * default pattern은 "YYYYMMDD"이다.
 * @sig    : [pattern]
 * @param pattern  : optional 변환하고자 하는 패턴 스트링. (default : YYYYMMDD)
 * <pre>
 *     # syntex
 *
 *       YYYY : hour in am/pm (1~12)
 *       MM   : month in year(number)
 *       MON  : month in year(text)  예) "January"
 *       mon  : short month in year(text)  예) "Jan"
 *       DD   : day in month
 *       DAY  : day in week  예) "Sunday"
 *       day  : short day in week  예) "Sun"
 *       hh   : hour in am/pm (1~12)
 *       HH   : hour in day (0~23)
 *       mm   : minute in hour
 *       ss   : second in minute
 *       SS   : millisecond in second
 *       a    : am/pm  예) "AM"
 * </pre>
 *  @returns {string} : Date를 표현하는 변환된 String.
 */
Date.prototype.format = function (pattern) {
    var year = this.getFullYear();

    var month = this.getMonth() + 1;
    var day = this.getDate();
    var dayInWeek = this.getDay();
    var hour24 = this.getHours();
    var ampm = (hour24 < 12) ? "AM" : "PM";
    var hour12 = (hour24 > 12) ? (hour24 - 12) : hour24;
    var min = this.getMinutes();
    var sec = this.getSeconds();

    var YYYY = "" + year;
    var YY = YYYY.substr(2);
    var MM = (("" + month).length == 1) ? "0" + month : "" + month;
    var MON = CAL_INITIAL.MONTH_IN_YEAR[month - 1];
    var mon = CAL_INITIAL.SHORT_MONTH_IN_YEAR[month - 1];
    var DD = (("" + day).length == 1) ? "0" + day : "" + day;
    var DAY = CAL_INITIAL.DAY_IN_WEEK[dayInWeek];
    var day = CAL_INITIAL.SHORT_DAY_IN_WEEK[dayInWeek];
    var HH = (("" + hour24).length == 1) ? "0" + hour24 : "" + hour24;
    var hh = (("" + hour12).length == 1) ? "0" + hour12 : "" + hour12;
    var mm = (("" + min).length == 1) ? "0" + min : "" + min;
    var ss = (("" + sec).length == 1) ? "0" + sec : "" + sec;
    var SS = "" + this.getMilliseconds();

    var dateStr;
    var index = -1;

    if (typeof (pattern) == "undefined") {
        dateStr = "YYYYMMDD";
    } else {
        dateStr = pattern;
    }

    dateStr = dateStr.replace(/YYYY/g, YYYY);
    dateStr = dateStr.replace(/YY/g, YY);
    dateStr = dateStr.replace(/MM/g, MM);
    dateStr = dateStr.replace(/MON/g, MON);
    dateStr = dateStr.replace(/mon/g, mon);
    dateStr = dateStr.replace(/DD/g, DD);
    dateStr = dateStr.replace(/DAY/g, DAY);
    dateStr = dateStr.replace(/day/g, day);
    dateStr = dateStr.replace(/hh/g, hh);
    dateStr = dateStr.replace(/HH/g, HH);
    dateStr = dateStr.replace(/mm/g, mm);
    dateStr = dateStr.replace(/ss/g, ss);
    dateStr = dateStr.replace(/(\s+)a/g, "$1" + ampm);

    return dateStr;
};

/**
 * Page

 /**
 * @module Page
 *
 * @description
 * websquare  관련 함수
 *
 * @example
 * var moPage = new Page();
 */
var Page = function () {
    /**
     *
     * @description
     *    Page.getControl 을 이용해 Control 객체를 반환받을 때 같은 컨트롤의 반복 생성을 방지하기 위해 임시 저장하는 Map
     */
    this.moCtrlMap = new MapEx();

    /**
     * @description
     * path
     */
    this.path = {};

    /**
     * @function
     * getInstance
     *
     * @description
     * getInstance(psInstancePath);
     * 지정된 노드의 xml instance 를 반환
     *
     * @param psInstancePath  얻고자 하는 xml instance 경로
     * @returns {Instance}
     *
     * @example
     * page.getInstance("/root/resList/mainList/list")
     */
    this.getInstance = function (psInstancePath) {
        return new Instance(this, psInstancePath);
    };


    /**
     * @function
     * get
     *
     * @description
     * 지정된 노드의 value값을 반환
     *
     * @param psInstancePath
     * @param psValue
     * @returns {*}
     *
     * @example
     * page.get("/root/requestKey/st_date")
     */
    this.get = function (psInstancePath, psValue) {
        if (psValue == "" || psValue == null || psValue == undefined) {
            return WebSquare.ModelUtil.getInstanceValue(psInstancePath);
        } else {
            return WebSquare.ModelUtil.getInstanceValue(psInstancePath + "/" + psValue);
        }
    };

    /**
     * @function
     * set
     *
     * @description
     * 지정된 노드의 value값을 세팅
     *
     * @param psInstancePath
     * @param psValue
     * @returns {boolean|*}
     *
     * @example
     *  page.set("/root/requestKey/st_date", "20141212")
     */
    this.set = function (psInstancePath, psValue) {
        if (psInstancePath == null || psInstancePath == "" || psInstancePath == undefined) {
            //alert("[Page.set]Instanse 값이 없습니다.");
            return false;
        }
        return WebSquare.ModelUtil.setInstanceValue(psInstancePath, psValue);

    };

    /**
     * @function
     * isPopup
     *
     * @description
     * 해당페이지의 팝업 여부
     *
     * @returns {boolean}
     */
    this.isPopup = function () {
        var vsPopupID_Page = WebSquare.net.getParameter("popupID");
        if (vsPopupID_Page != "") {
            return true;
        } else {
            return false;
        }
    };

    /**
     * @function
     * getMediaAuth
     *
     * @description
     * 헤더의 권한정보 리턴
     *
     * @param psNode
     * @returns {*}
     */
    this.getMediaAuth = function (psNode) {
        return WebSquare.ModelUtil.getInstanceValue("responseHeader/listHeader/object/" + psNode);
    };
    /**
     * @function
     * getPage
     *
     * @description
     * 지정한 Viewer 의 이름과 일치하는 Page 객체를 반환
     *
     * @param psViewerName
     * @returns {Page|*}
     *
     * @example
     *  page.getPage("opener"); 를 하게되면 팝업에서 부모 창 객체를 얻을 수 있다.
     *  page.getPage();         를 하게되면 현재 페이지 객체를 얻을 수 있다.
     */
    this.getPage = function (psViewerName) {
        if (psViewerName == "opener") {
            return METHODIACom.getParentPage();
        } else {
            return this;
        }

    };

    /**
     * @function
     * ctrlGet
     *
     * @description
     * 컨트롤의 값을 반환합니다.
     *
     * @returns {*}
     */
    this.ctrlGet = function (psCtrlID) {
        return WebSquare.util.getComponentById(psCtrlID).getValue();
    };

    /**
     * @function
     * ctrlSet
     *
     * @description
     * ctrlSet(psCtrlID, psValue);
     * 컨트롤에 값을 입력합니다.
     *
     * @param psCtrlID  컨트롤ID
     * @param psValue    세팅할 값
     */
    this.ctrlSet = function (psCtrlID, psValue) {
        WebSquare.util.getComponentById(psCtrlID).setValue(psValue);
    };
    return this;
};



/**
 * MDI 객체
 * static class : MDI 객체
 *
 * @constructor
 */

var MDI = function () {
    /**
     *  MDI 창 열기
     * @param psPgmExt     패키지 경로
     * @param psScrnPgmId   호출할 파일ID
     * @param psPgmName    호출되는 화면의 MDI 메뉴명
     * @param psJson       파라미터 Json
     * @param psMenuId    메뉴ID
     * @param psSkip      DB 호출 Skip 여부  (null or true 이면, skip, false : DB 권한 체크 )
     *
     * @example
     * var paramValue = {} ;
     *     paramValue.ioFlag = "U";
     *     paramValue.guBun = "U";
     *     paramValue.vsTitle = "큐시트 등록";
     *
     *     var voMDI = new MDI();
     *     voMDI.open("sale.bs.cm", "bscm0210e01", "거래명세표", paramValue , null , true );
     *
     *     ##해당페이지에서 파라미터  : Comm.getWinParams()
     */
    this.open = function (psPgmExt, psScrnPgmId, psPgmName, psJson, psMenuId, psSkip) {
        if (!WebSquare.session.getAttribute("sessionFlag")) {
            return;
        }
        var url = psPgmExt.replaceAll(".", "/")+"/" + psScrnPgmId + ".xml?linkYn="+ WebSquare.text.BASE64URLEncoder("Y");
            url = url + "&menuNm=" +  WebSquare.text.BASE64URLEncoder(psPgmName);
            url = url + "&scrnPgmId=" + WebSquare.text.BASE64URLEncoder(psScrnPgmId)    ;
            if((psMenuId||'') == !"" ){
                url = url + "&menuId=" +psMenuId    ;
            }

          if( psJson != null && psJson != undefined ){
              Object.keys(psJson).forEach(function(key){
                  url = url + "&"+key+"="+ WebSquare.text.BASE64URLEncoder(  psJson[key]  );
              });
          }

        //기존화면 id
        var fstMenuId = "" ;
        var vsWindowId = "N_"+(psMenuId||psScrnPgmId||"")  ;
        var orgMenu = Comm.xmlToJson("responseHeader/listHeader/object");
        if( !orgMenu ){
            vsWindowId =  (psMenuId || orgMenu.menuId) ;
            fstMenuId = orgMenu.fstMenuId   ;
        }

        if (psSkip != undefined && psSkip == true) {
            if (Comm.getUserInfo("mobileYn") == "Y") {
                //모바일인경우
                window.open('/websquare/websquare.jsp?w2xPath=/modules/' + url, '_blank'); // 모바일 크롬에 때문에 팝업 이름은 꼭 _blank 로
            } else {
                //마지막 파라미터에 mdi호출여부 "Y"값을 준다
                parent.callNewWindow(psPgmName, url, psPgmName, vsWindowId, null, fstMenuId, null, "Y");
            }
        } else {
            var poParam ={
               "scrn_pgm_id" :psScrnPgmId
              ,"scrn_pgm_ext":psPgmExt
              , "menuId": (psMenuId||"")
            }
            //넘어온 메뉴코드로 해당메뉴의 세부사항을 다시 조회
            var actionUrl = "/sys/menu/selectMenu.do";
            Comm.extSubmission("subMenu", actionUrl, poParam, "Y",
                function (subId, voJson) {
                try{
                    /*
                       todo   : 권한체크 여부
                    **/
                    var mnObj = voJson.menu   ;
                    if (Comm.getUserInfo("mobileYn") == "Y") {
                        //모바일인경우
                        window.open('/websquare/websquare.jsp?w2xPath=/modules/' + url, '_blank'); // 모바일 크롬에 때문에 팝업 이름은 꼭 _blank 로
                    } else {
                        //마지막 파라미터에 mdi호출여부 "Y"값을 준다
                        parent.callNewWindow(psPgmName, url, psPgmName, vsWindowId, null, fstMenuId, "", "Y");
                    }
                }catch (e) {
                    console.log(e)
                }
            });
        }
    };

    /**
     * return Object를 반환한다.
     */
    this.getRtnValue = function () {
        return WebSquare.session.getAttribute("moRtnObj");
    };

    /**
     * 메소드의 returnObject를 세팅한다.
     *
     * Object  poRtnObj  호출하는 화면에 넘겨줄 Param Object 객체
     */
    this.returnValue = function (poRtnObj) {
        WebSquare.session.setAttribute("moRtnObj", poRtnObj);

    };

    /**
     * 초기화
     */
    this.reset = function () {
        WebSquare.session.removeAttribute("moRtnObj");

    };
};

