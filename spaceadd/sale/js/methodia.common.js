/**
 * METHODIAComFactory  :
 * METHODIACom      : 공통 function
 * Valid       : ValidationCheck
 * MDI            : MDI 객체
 * AuthUtil       : 사용자 권한 Util
 */

/**
 *
 * @param {Object} psFunctionName
 */

var METHODIACom = {
    /**
     * sendCmnCode
     *
     * String  psReqNode    ref 세팅
     * String  psResNode    결과 res 세팅
     * String  psAction        Action 세팅
     */
    sendCmnCode: function (psReqNode, psResNode, psAction) {
        var rtn = true;

        var option = {};
        option.action = psAction;
        option.mediatype = "application/json";
        option.method = "post";
        option.requestData = JSON.stringify( Comm.xmlToJson(psReqNode));
        option.type = "json";
        option.mode = "synchronous";
        option.beforeAjax = function (e) {
            return true;
        };
        option.success = function (e) {
            $('.loading').hide();
            $('.poploading').hide();

            var outData = e.responseText;
            var voJson = JSON.parse(outData);
            //alert("voJson.ERRMSG"+voJson.ERRMSG);
            if (voJson.ERRMSG != null && voJson.ERRMSG != "") {
                alert(voJson.ERRMSG);
                //세션오류일 경우 login 페이지로
                if (voJson.ERRCODE == "SYS-00000") {
                    //alert(" Comm.js 에서 세선종료");
                    top.opener = "nothing";
                    top.open('', '_parent', '');
                    top.close();
                }
                rtn = false;
                return true;
            }
            var vaKey = Object.keys(voJson);
            for (var i = 0; i < vaKey.length; i++) {
                //인스턴스 생성
                 Comm.jsonToXml(voJson[vaKey[i]], psResNode, vaKey[i]);

            }
        };
        option.error = function (e) {
            alert("Server Connectoin Error!");
            $('.loading').hide();
            $('.poploading').hide();
            rtn = false;
        };
        $('.loading').show();
        $('.poploading').show();
        WebSquare.net.ajax(option);
        return rtn;
    },

    /**
     * 컨트롤에 title을 세팅한다.
     *
     * String   psTitle    세팅할 값
     * Array    paCtrlAll    All ControlId : 모든 ControlID들
     * Array    paCtrl       세팅할 ControlID들
     */
    setCtrlLabelId: function (psTitle, paCtrlAll, paCtrl) {
        if (paCtrl != null && paCtrl != "All") {
            var vnLen = paCtrl.length;
            var vaCtlId = [];
            for (var i = 0; i < vnLen; i++) {
                vaCtlId[i] = paCtrlAll[paCtrl[i] - 1];
            }
            paCtrlAll = vaCtlId;
        }

        var vnCtrlId = paCtrlAll.length;
        for (var i = 0; i < vnCtrlId; i++) {
            var vcCtrl = WebSquare.util.getComponentById(paCtrlAll[i]);
            var vcCtrlName = vcCtrl.getPluginName();
            if (vcCtrlName == "inputCalendar") {
                vcCtrl.setUserData("titleTemp", psTitle);
            } else {
                vcCtrl.setTitle(psTitle);
            }
        }
    },


    msSalesId: "",		//영업사원ID
    mbSetSaleId: false,	//사용자가 세팅한 적이 있는지 여부

    /**
     * 영업사원ID 세팅
     *
     * String  psSaleUserId     영업사원ID
     */
    setSaleId: function (psSaleId) {
        METHODIACom.msSalesId = psSaleId;
        METHODIACom.mbSetSaleId = true;
    },

    /**
     * 영업사원ID 반환
     */
    getSaleId: function () {
        return METHODIACom.msSalesId;
    },

    /**
     * 영업사원ID 세팅 여부
     */
    getSaleIdSetFlag: function () {
        return METHODIACom.mbSetSaleId;
    },

    /**
     * 최상위 부모 객체 Page 반환
     */
    getParentPage: function (poPage) {
        var voPage = null;
        if (poPage == null || poPage == undefined) {
            voPage = new Page();
        } else {
            voPage = poPage;
        }
        var parentObj = opener || parent;
        while (voPage.isPopup()) {
            voPage = parentObj.Comm.getPageObj();
            parentObj = parentObj.opener || parentObj.parent;
        }
        return voPage;
    },


    /**
     * url parameter 의 값 얻기
     *
     * String   psName  얻을 parameter Name명
     *
     */
    getXtmParameter: function (psName) {
        var vsRntValu = "";
        vsRntValu = WebSquare.net.getParameter(psName);
        return vsRntValu;
    },

    /**
     * LabelId의 Message를 얻는다.
     *
     * Object   pcCtrl    해당 Control객체
     * Object   poPage    page 객체 (생략가능, default : 현재 Page객체)
     */
    getLabelIdMsg: function (pcCtrl, poPage, psAttrName) {
        return pcCtrl.getTitle();
    },


    /**
     * 공통코드 조회한다(일괄처리).
     * @param poOption : Object
     * @param poOption.id : 컴포넌트 id ex) cbbSpb
     * @param poOption.code : 공통코드 (code_type) ex)"SPB"
     * @param poOption.useritem : 사용자 정의 아이템. 디폴트값. ( "0" = 선택, "1" = 전체, "" = 없음 )     ex) "0"/"1"/""
     * @param poOption.filter : 필터. ex)"[CODE='SPB01' or CODE='SPB02']"
     * @param poOption.select : 초기 선택값 ex) ""
     */
    doGetAA02List: function (psOption) {
        Comm.getCmnCode(psOption);
    },

    /**
     * 본지사코드 조회한다
     * @param poOption : Object
     * @param poOption.id : 컴포넌트 id ex) cbbSpb
     * @param poOption.reqRef : 조회조건의 xmlpath
     * @param poOption.resRef : 조회결과의 xmlpath
     * @param poOption.useritem : 사용자 정의 아이템. 디폴트값. ( "0" = 선택, "1" = 전체, "" = 없음 )     ex) "0"/"1"/""
     * @param poOption.filter : 필터. ex)"[CODE='SPB01' or CODE='SPB02']"
     * @param poOption.select : 초기 선택값 ex) ""
     */
    doGetAB21List: function (psOption) {
        //Common.getBrnchCode(psOption);
    },


    /**
     * 권한노드복사
     *
     * String   psNodePath    target
     */
    copyMediaAuth: function (psNodePath) {
        WebSquare.ModelUtil.copyChildrenNodes("responseHeader/listHeader/object", psNodePath, "append");

    },


    /*
     * 그리드에 이미지 표현하기 위한  함수
     * 소재미리보기 viewGbn : 'S', 확정이미지 : 'A'
     */
    setGridImage: function (value) {
        var retstr = "";
        if (value == "O") {
            retstr = "<span style='height=20px;'><image src='/images/btn_play.png' ></span>";
        }
        //2015.12.10 간접광고신청에서 파일이미지 나타내기 김동건 추가
        if (value.substr(0, 3) == "IMG") {
            retstr = "<span style='height=20px;'><image src='/images/ico_shp01.png' ></span>";
        }
        return retstr;
    },

    /*
     * 소재미리보기 팝업 생성하는 프로그램
     */
    popMtrlView: function (voGrid, rowIdx, colIdx, option1) {
        var vnHeight = "770";
        var vsOnlyPlayerYn = "N"; //소재상세설명 유무 옵션 추가.
        if (option1 == "Y") {
            vsOnlyPlayerYn = "Y";
        }
        var colName = "";
        if (checkRealGrid(voGrid)) {
            var curObject = voGrid.getCurrent();
            colName = curObject.column;
        } else {
            colName = voGrid.getColumnID(colIdx); // 컬럼명 확인
        }
        if (colName == "mtrlViewImg" || colName == "mtrlView") {
            var vsMtrlView = voGrid.getCellData(rowIdx, "mtrlView");
            if (vsMtrlView == "O") {  // vsMtrlView의 값이 O 이어야 하지만 이미지 포매터 사용으로 이미지의 경로 값이 들어오게 된 상황임.
                //심의번호
                var vsInspNo = voGrid.getCellData(rowIdx, "inspNo");

                var vsCliCode = "";
                try {
                    vsCliCode = voGrid.getCellData(rowIdx, "cliCode");
                } catch (e) {
                    MsgBox.show("광고주정보가 없습니다. IT팀에 문의하세요.");
                    return;
                }
                var voMtrlCond = {};
                voMtrlCond.vsInspNo = vsInspNo;
                voMtrlCond.vsCliCode = vsCliCode;
                voMtrlCond.vsOnlyPlayerYn = vsOnlyPlayerYn;
                voMtrlCond.wmvFileOrg = "";
                if (vsOnlyPlayerYn == "Y") {
                    voMtrlCond.wmvFileOrg = voGrid.getCellData(rowIdx, "wmvFileOrg");
                    vnHeight = "470";
                }
                var poParam = {
                    popupUrl: "/modules/common/cmnpMtrlView.xml"
                    , width: 800
                    , height: vnHeight
                    , type: "window"
                    , useIFrame: false // false 면 window open, true면 modal창
                    , popupName: "소재미리보기"
                    , resize: true
                    , scroll: false
                    , json: voMtrlCond
                };
                Comm.callPopup(poParam);
                return false;
            }
            return false;
        }

        return true;


    },

    /**
     * 화면들에서 요금계산을 하기 위한 용도의 함수
     *
     * @param psReqNode : 요금계산 요청할 param 노드 (각자 화면에 노드를 생성해야함) ex) /root/requestChkMtrl
     * @param psResNode : msg 값 return 받는 노드(각자 화면에 노드를 생성해야함) ex) /root/responseChkMtrl
     * @param poParam : 요금계산시 필요한 param 값들
     *    poParam.recNo            -- 그리드 row no값 ( 1건 일 경우 0을 보낸다)
     *    poParam.frmNo            -- 편성번호
     *    poParam.stDate           -- 청약시작일자
     *    poParam.edDate           -- 청약종료일자
     *    poParam.agncyCode        -- 광고회사코드
     *    poParam.agncyOffcCode    -- 광고회사코드
     *    poParam.cliCode          -- 광고주코드
     *    poParam.agntContSeqNo    -- 대행계약일련번호
     *    poParam.agntContBrndSeqNo-- 대행계약품목일련번호
     * @return      "P" : confirm 창에서 예를 선택할 경우 /
     *              "F" : 오류 또는 실패 /
     *              "N" : confirm 창에서 아니오를 선택할 경우 /
     *              "Y" : confirm메시지 없을 경우 통과 /
     *
     */
    retrieveCalAmt: function (psReqNode, psResNode, poParam) {

        var midBandCode = ""; //중간광고 요금계산시 광고구분코드에 midBandCode가 붙여서 들어간다. ex) SPB11DYA10
        // 일반광고일때 undifined로 들어올수도 있음

        if (poParam.midBandCode == "undefined" || poParam.midBandCode == "" || poParam.midBandCode == "null" || poParam.midBandCode == undefined) {
            midBandCode = "";
        } else {
            midBandCode = poParam.midBandCode;
        }
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/contTypeCode", poParam.contTypeCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/salePathCode", poParam.salePathCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brdCompCode", poParam.brdCompCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mediaCode", poParam.mediaCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/frmNo", poParam.frmNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pFrmAmtSeqNo", poParam.pFrmAmtSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/stDate", poParam.stDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mtrlSec", poParam.mtrlSec);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/sbscrTypeCode", poParam.sbscrTypeCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/cliCode", poParam.cliCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyCode", poParam.agncyCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyOffcCode", poParam.agncyOffcCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/area", (poParam.area).simpleReplace(",", ""));
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/Yn", poParam.Yn);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/adjRt", poParam.adjRt);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/opCnt", poParam.opCnt);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/edDate", poParam.edDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pSgCode", poParam.sgCode); // 뭔지 모르겠음
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pIdx", poParam.idx); // 뭔지 모르겠음
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mmr", poParam.mmr); // 뭔지 모르겠음
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/adKndCode", poParam.adKndCode + midBandCode);//20210504 중간광고
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/adTypeCode", poParam.adTypeCode);

        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brndSeqNo", poParam.brndSeqNo);	//2018.02.06 add 인포모셜광고여부 가져오기 위해 추가
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/repMtrlSeqNo", poParam.repMtrlSeqNo);	//2018.02.06 add 인포모셜광고여부 가져오기 위해 추가
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mtrlSeqNo", poParam.mtrlSeqNo);	//2018.02.06 add 인포모셜광고여부 가져오기 위해 추가
        if (!METHODIACom.sendCmnCode(psReqNode, psResNode, "/com/common/calAmt2.do")) {
            // 에러가 있으면 끝
            return false;
        } else {
            return true;
        }

    },

    /**
     * 운행의뢰발송요청 및 방송사발송 동시에 가능토록. (바로확정처리)
     * @param psReqNode : 운행의뢰발송요청 및 방송사발송 요청할 param 노드 (각자 화면에 노드를 생성해야함) ex) /root/requestChkMtrl
     * @param psResNode : msg 값 return 받는 노드(각자 화면에 노드를 생성해야함) ex) /root/responseChkMtrl
     * @param poParam : 요금계산시 필요한 param 값들
     *
     */
    saveOrSend: function (psReqNode, psResNode, poParam) {

        if (MsgBox.showYesNo("바로 확정처리(운행의뢰발송요청 및 방송사발송)(이)가 진행됩니다.\n처리 하시겠습니까?", "확인") == MsgBox.IDNO) {
            return false;
        }
        var regKndCode = poParam.regKndCode;
        var frmName = poParam.frmName;
        var cliName = poParam.cliName;
        var apprvName = "";

        if (regKndCode == "SHC01") {			//정기물/Upfront
            var pYearmon = poParam.pYearmon;

            if (poParam.pContTypeCode == "SSD01")	//Upfront
                apprvName = "업프런트-" + pYearmon.substring(0, 4) + "년" + pYearmon.substring(4) + "월-" + poParam.title;
            else
                apprvName = "정기물-" + pYearmon.substring(0, 4) + "년" + pYearmon.substring(4) + "월-" + poParam.title;

        } else if (regKndCode == "SHC02") {		//특집/이동프로그램
            apprvName = poParam.adTypeName + "-" + poParam.title;
        } else if (regKndCode == "SHC06") {		//임시물
            apprvName = "임시물-" + "-" + poParam.title;
        } else if (regKndCode == "SHC07") {		//소재변경
            apprvName = "소재변경-" + poParam.title;
        } else if (regKndCode == "SHC09") {		//선매
            var minStDate = poParam.minStDate;

            apprvName = "선매-" + poParam.title + "-" + minStDate.substring(0, 4) + "년" + minStDate.substring(4, 6) + "월";
        } else if (regKndCode == "SHC10") {		//CM순서지정
            var fixdOccsTypeCode = poParam.fixdOccsTypeCode;

            if (fixdOccsTypeCode == "SHV01") {	//정기판매
                var desigSaleYearmon = poParam.desigSaleYearmon;

                apprvName = "CM지정-" + poParam.title + "-" + desigSaleYearmon.substring(0, 4) + "년" + desigSaleYearmon.substring(4) + "월";
            } else {	//수시판매
                var minStDate = poParam.minStDate;

                apprvName = "CM지정-" + poParam.title + "-" + minStDate.substring(0, 4) + "년" + minStDate.substring(4, 6) + "월";
            }
        } else if (regKndCode == "SHC11") {		//벤처광고주
            apprvName = "벤처광고주-" + poParam.title;
        } else if (regKndCode == "SHC12") {		//대행이동
            apprvName = "대행이동-" + poParam.title;
        } else if (regKndCode == "SHC13") {		//청구지변경
            apprvName = "청구지변경-" + poParam.title;
        } else if (regKndCode == "SHC15") {		//추가교체
            apprvName = "교체방송-" + poParam.title;
        } else if (regKndCode == "SHC17") {		//중소광고주
            var sbscrStDate = poParam.sbscrStDate;

            apprvName = "중소광고주-" + poParam.title + "-" + sbscrStDate.substring(0, 4) + "년" + sbscrStDate.substring(4, 6) + "월";
        } else if (regKndCode == "SHC19") {	                      // 가상광고
            apprvName = poParam.title;
        } else if (regKndCode == "SHC20") {                       // 간접광고
            apprvName = poParam.title;
        } else if (regKndCode == "SHC23") {		//중지
            apprvName = "중지-" + /*pObj.opTypeName.trim() + */ "-" + poParam.title;
        } else if (regKndCode == "SHC24") {		//CM지정중지
            apprvName = "CM지정중지-" + poParam.title;
        } else if (regKndCode == "SHC26") {
            apprvName = "DMB패키지중지-" + poParam.title;
        } else if (regKndCode == "SHC36") {
            apprvName = "DMB패키지대행이동-" + poParam.title;
        } else if (regKndCode == "SHC37") {
            apprvName = "DMB패키지청구지변경-" + poParam.title;
        } else {
            apprvName = poParam.title;
        }

        var voDate = new Date();
        var voDate2 = voDate.format("YYYY-MM-DD");

        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/apprvYm", voDate2);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brdCompCode", poParam.brdCompCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mediaCode", poParam.mediaCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/areaCode", poParam.areaCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/adKndCode", poParam.adKndCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orKndCode", poParam.orKndCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pSbscrSeqNo", poParam.pSbscrSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pFrmNo", poParam.pFrmNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/apprvUserName1", poParam.orName);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/apprvUserDept1", poParam.orDeptName);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/apprvUserId1", poParam.orId);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/deptCode", poParam.deptCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orTitle", apprvName);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pFrmNo", poParam.pFrmNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pSbscrSeqNo", poParam.pSbscrSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orKndCode", poParam.orKndCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brdCompCode", poParam.brdCompCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mediaCode", poParam.mediaCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/areaCode", poParam.areaCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/adTypeCode", poParam.adTypeCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/adKndCode", poParam.adKndCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/apprvKndCode", poParam.apprvKndCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brnchCode", poParam.brnchCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/sendTypeCode", poParam.sendTypeCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orId", poParam.orId);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pOrId", poParam.orId);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orName", poParam.orName);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orDept", poParam.orDeptName);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orOrd", "1");
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/apprvTypeCode", "");
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/airBizCode", poParam.airBizCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/opTypeCode", poParam.opTypeCode);
        //운행정산파트에서 운행의뢰 발송요청이 direct로 처리될 수 있도록 파라미터 추가
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/regKndCode", poParam.regKndCode);

        //소재변경 파람, CM지정 파람 추가
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mcrYearmon", poParam.mcrYearmon);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mcrSeqNo", poParam.mcrSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/captChgSeqNo", poParam.captChgSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/sbscrCrrntCode", poParam.sbscrCrrntCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/desigSeqNo", poParam.desigSeqNo);

        //중지신청일련번호
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/osrSeqNo", poParam.osrSeqNo);
        //DMB패키지 중지용 - 권성훈
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/pgmId", poParam.pgmId);        // single
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/orderSeqNo", poParam.orderSeqNo);   // multi
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/prodTypeCode", poParam.prodTypeCode); // multi(동일한 유형으로만 던지는 중)
        //debugger;
        if (!METHODIACom.sendCmnCode(psReqNode, psResNode, "/sale/sc/bc/scbc0030p01/subReqSaveNew.do")) {
            return false;
        } else {
            MsgBox.show("성공적으로 처리되었습니다.");
            return true;
        }

    },

    vnGGCnt: 0,
    /*****************************************************************
     * getRealDt                                                     *
     * 방송시작일자와 방송요일을 파라미터로 받아서 첫 실제방송시작일 *
     * 을 조회한다.                                                  *
     *****************************************************************/
    getRealDt: function (pStDate, pSunYn, pMonYn, pTueYn, pWedYn, pThuYn, pFriYn, pSatYn) {
        var varRealBrdDt = null;
        var vnCnt = 0;
        var varDayArray = [pSunYn, pMonYn, pTueYn, pWedYn, pThuYn, pFriYn, pSatYn];

        // 실방송일자 조회
        for (var i = 0; i <= 6; i++) {
            var varDt = ValueUtil.fixNumber(pStDate) + i;
            var varDate = DateUtil.toDate(varDt + "", "YYYYMMDD");
            var varDay = varDate.getDay();

            if (varDayArray[varDay] == "Y") {
                varRealBrdDt = varDate.format("YYYYMMDD");
                break;
            }
            vnCnt++;
            vnGGCnt = vnCnt;
        }

        return varRealBrdDt;
    },

    /**
     * ComboBox 전체 추가
     *
     * Array   paCtrlId    해당 ControlID들
     */
    setComboTotAdd: function (paCtrlId) {
        var vnCnt = paCtrlId.length;
        for (var i = 0; i < vnCnt; i++) {
            //var vcCtrl = page.getControl(paCtrlId[i]);
            var vcCtrl = WebSquare.util.getComponentById(paCtrlId[i]);
            vcCtrl.addItem("%", "-전체-", 0);
        }
    }
    ,

    /**
     * 오늘 일자 & 시간을 가져온다(YYYYY-MM-DD HH:mm:ss)
     * 24 시간제
     *
     * @param psFormat   포멧형식
     * @returns {*|string}
     */
    getToDateTime: function (psFormat) {
        var vsFormat = "YYYY-MM-DD HH:mm:ss";
        if (psFormat != undefined && psFormat != "" && psFormat != null) {
            vsFormat = psFormat;
        }
        return this.getDate(vsFormat);
    },

    /**
     *  오늘 일자를 가져온다(YYYY-MM-DD)
     *
     * @param psFormat 포멧형식
     * @returns {*|string}
     */
    getDate: function (psFormat) {
        var vsToDate = new Date().format(psFormat);
        return vsToDate;
    },

};

var METHODIAValid = {
    /*--------------------------------------------
        함수		: fCheckRequire
        파라미터	: Object    paCtrlId   체크할 컨트롤Id ArrayObject
        리턴		: true/false
        작용		: 조회 버튼 클릭시 검색조건의 필수값을 체크한다.
    ----------------------------------------------*/
    checkRequire: function (paCtrlId) {
        var vnLen = paCtrlId.length;

        for (var i = 0; i < vnLen; i++) {
            //해당 컨트롤 내부 자식 컴포넌트 객체를 배령레 담는다
            var arrChildObj = WebSquare.util.getChildren(WebSquare.util.getComponentById(paCtrlId[i]), {
                excludePlugin: "trigger output group image",
                recursive: true
            });
            var vnChildObj = arrChildObj.length;

            //내부객체의 갯수가 0이면 현재 오브젝트가 조회조건에 사용되는 객체로 간주한다.
            if (vnChildObj == 0) {
                try {
                    //객체에 설정된 title프로퍼티의 값
                    //title의 값이 존재할때만 조회필수 조건으로 간주한다.
                    var voCtrl = WebSquare.util.getComponentById(paCtrlId[i]);
                    var vsTitle = "";
                    if (voCtrl.getPluginName() == "inputCalendar") {
                        vsTitle = voCtrl.getUserData("titleTemp");
                    } else {
                        vsTitle = voCtrl.getTitle();
                    }
                    if (vsTitle != "" && vsTitle != null && vsTitle != undefined) {
                        //타이틀이 존재하면 해당 컨트롤의 값을 가져와 값이 있는지 체크한다.
                        var vsValue = voCtrl.getValue();
                        if (vsValue == "") {
                            ComMsg.error("M002", [vsTitle]);
                            voCtrl.focus();
                            return false;
                        }
                    }
                } catch (e) {
                }
            } else {
                for (var j = 0; j < vnChildObj; j++) {
                    try {
                        //객체에 설정된 title프로퍼티의 값
                        //title의 값이 존재할때만 조회필수 조건으로 간주한다.
                        var voCtrl = arrChildObj[j];
                        var vsTitle = "";
                        if (voCtrl.getPluginName() == "inputCalendar") {
                            vsTitle = voCtrl.getUserData("titleTemp");
                        } else {
                            vsTitle = voCtrl.getTitle();
                        }
                        if (vsTitle != "" && vsTitle != null && vsTitle != undefined) {
                            //타이틀이 존재하면 해당 컨트롤의 값을 가져와 값이 있는지 체크한다.
                            var vsValue = voCtrl.getValue();
                            if (vsValue == "") {
                                ComMsg.error("M002", [vsTitle]);
                                voCtrl.focus();
                                return false;
                            }
                        }
                    } catch (e) {
                    }
                }

            }
        }
        return true;
    },


    /**
     * 검색 일자 유효성체크
     *
     * @param psStartYmd  검색시작일자 controlId
     * @param psEndYmd    검색종료일자 controlId
     * @param psDays    시작,끝 기간 (ex: 7일-7, 1개월-30..)
     * @returns {boolean}
     */
    checkDate: function (psStartYmd, psEndYmd, psDays) {
        var vcStartYmd = WebSquare.util.getComponentById(psStartYmd);
        var vcEndYmd = WebSquare.util.getComponentById(psEndYmd);
        var vsStDt = vcStartYmd.getValue();
        var vsEndDt = vcEndYmd.getValue();

        //시작일자 컨트롤의 메시지
        var vsLabelMsg = METHODIACom.getLabelIdMsg(vcStartYmd);

        //종료일자 컨트롤의 메시지
        if (vsLabelMsg == "") {
            vsLabelMsg = METHODIACom.getLabelIdMsg(vcEndYmd);
        }
        if (vsStDt == "") {
            ComMsg.error("M002", [vsLabelMsg]);
            vcStartYmd.focus();
            return false;
        }

        if (vsEndDt == "") {
            vsLabelMsg = METHODIACom.getLabelIdMsg(vcEndYmd);
            ComMsg.error("M002", [vsLabelMsg]);
            vcEndYmd.focus();
            return false;
        }

        if (vsStDt > vsEndDt) {
            ComMsg.error("M039");
            vcStartYmd.focus();
            return false;
        }
        var vnPeriod = DateUtil.getDaySpan(DateUtil.toDate(vsEndDt, "YYYYMMDD"), DateUtil.toDate(vsStDt, "YYYYMMDD"));
        if (!ValueUtil.isNull(psDays) && psDays != null && psDays != undefined) {
            if (vnPeriod > psDays) {
                MsgBox.show(vsLabelMsg + " " + psDays + " 이상으로 설정할수 없습니다.");
                return false;
            }
        }
        return true;
    },

    /**
     * yyyymmdd 형식의 날짜값을 입력받아서 유효한 날짜인지 체크한다.
     * ex) isValidDate("20070415");
     */
    isValidDate: function (iDate) {
        if (iDate.length != 8) {
            return false;
        }

        var oDate = new Date();
        oDate.setFullYear(iDate.substring(0, 4));
        oDate.setMonth(parseInt(iDate.substring(4, 6)) - 1);
        oDate.setDate(iDate.substring(6));

        if (oDate.getFullYear() != iDate.substring(0, 4)
            || oDate.getMonth() + 1 != iDate.substring(4, 6)
            || oDate.getDate() != iDate.substring(6)) {

            return false;
        }

        return true;
    },

    /**
     * 계약/청약 등록 공통 체크
     *
     * @param String pnChkDiv       체크구분 [1 : 계약/청약 기간 체크]
     * @param Object poParam        파라메터 Object
     *  poParam String sbscrCrrntCode 가/실 구분 [SHX01 : 가청약, SHX02 : 실청약]
     *  poParam String brdCompCode    방송사 코드
     *  poParam String mediaCode      매체 코드
     *  poParam String contTypeCode   판매시장구분 코드 [SSD]
     *  poParam String salePathCode   판매경로구분 코드 [SSU]
     *  poParam String contKndCode    계약형태 코드 [SSN]
     *  poParam String discKndCode    할인유형 코드 [SSO]
     *  poParam String sbscrTypeCode  할인상세구분 코드 [SSA]
     *  poParam String saleYearmon    판매년월
     *  poParam String stDate         계약/청약 시작일
     *  poParam String edDate         계약/청약 종료일
     */
    checkSbscrVaild: function (pnChkDiv, poParam) {

        var vaRtnValue = [];

        var vsSbscrCrrntCode = poParam.sbscrCrrntCode;
        var vsBrdCompCode = poParam.brdCompCode;
        var vsMediaCode = poParam.mediaCode;
        var vsContTypeCode = poParam.contTypeCode;
        var vsSalePathCode = poParam.salePathCode;
        var vsContKndCode = poParam.contKndCode;
        var vsDiscKndCode = poParam.discKndCode;
        var vsSbscrTypeCode = poParam.sbscrTypeCode;
        var vsSaleYearmon = poParam.saleYearmon;
        var vsStDate = poParam.stDate;
        var vsEdDate = poParam.edDate;

        switch (pnChkDiv) {
            case 1:	//계약/청약 기간 체크
                var vnDay = DateUtil.getDaySpan(DateUtil.toDate(vsEdDate, "YYYYMMDD"), DateUtil.toDate(vsStDate, "YYYYMMDD"));
                var vnMonth = Math.floor(vnDay / 30);
                var vnDay = vnDay % 30;

                if (vnMonth == 0) vnMonth = 1;	//판매기간이 1개월 미만일 경우
                else vnMonth = vnMonth + (vnDay >= 15 ? 1 : 0);
                var vsContTermTypeCode = "SSL" + (vnMonth <= 12 ? 20 + vnMonth : 33);	//계약/청약기간구분코드
                vnMonth = vnMonth * 1;
                if (vsSbscrCrrntCode == "SHX01") {	//가청약
                    if (vsContTypeCode == "SSD02") {	//Upfront,정기물
                        if (vnMonth > 13) {	//판매개월이 13개월 초과일 경우
                            MsgBox.show("업프런트, 정기물일 경우 13개월을 초과할수 없습니다.", "경고");
                            vaRtnValue.push("N");
                            vaRtnValue.push(vnMonth);
                            vaRtnValue.push(vsContTermTypeCode);
                        } else {
                            vaRtnValue.push("Y");
                            vaRtnValue.push(vnMonth);
                            vaRtnValue.push(vsContTermTypeCode);
                        }
                    } else if (vsContTypeCode == "SSD01") {
                        if (vsSalePathCode == "SSU04") { //2018.03.02 업프론트 선매 추가됨
                            vaRtnValue.push("Y");
                            vaRtnValue.push(vnMonth);
                            vaRtnValue.push(vsContTermTypeCode);
                        } else {
                            if (vnMonth > 13) {	//판매개월이 13개월 초과일 경우
                                MsgBox.show("업프런트, 정기물일 경우 13개월을 초과할수 없습니다.", "경고");
                                vaRtnValue.push("N");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            } else if (vnMonth < 1) {
                                vaRtnValue.push("N");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            } else {
                                vaRtnValue.push("Y");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            }
                        }
                    } else if (vsContTypeCode == "SSD03") {	//임시물
                        if (vsSalePathCode == "SSU01") {	//일반
                            if (vnMonth == 1) {
                                vaRtnValue.push("Y");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            } else if (vnMonth > 1) {	//판매개월이 1개월 초과일 경우
                                vaRtnValue.push("Y");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            }
                        } else {
                            vaRtnValue.push("Y");
                            vaRtnValue.push(vnMonth);
                            vaRtnValue.push(vsContTermTypeCode);
                        }
                    }
                } else {	//실청약

                    if (vsContTypeCode == "SSD01" || vsContTypeCode == "SSD02") {	//Upfront,정기물
                        if (vsContTypeCode == "SSD01" && vsSalePathCode == "SSU04") { //2018.03.02 업프론트 선매 추가됨
                            vaRtnValue.push("Y");
                            vaRtnValue.push(vnMonth);
                            vaRtnValue.push(vsContTermTypeCode);
                        } else {
                            if (vnMonth > 13) {	//판매개월이 13개월 초과일 경우
                                MsgBox.show("업프런트, 정기물일 경우 13개월을 초과할수 없습니다.", "경고");
                                vaRtnValue.push("N");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            } else {
                                vaRtnValue.push("Y");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            }
                        }
                    } else if (vsContTypeCode == "SSD03") {	//임시물

                        if (vsSalePathCode == "SSU01") {	//일반

                            if (vnMonth == 1) {
                                vaRtnValue.push("Y");
                                vaRtnValue.push(vnMonth);
                                vaRtnValue.push(vsContTermTypeCode);
                            } else if (vnMonth > 1) {	//판매개월이 1개월 초과일 경우

                                if (MsgBox.showYesNo("임시물 청약은 1개월 단위입니다. 그래도 처리하시겠습니까?", "확인") == MsgBox.IDYES) {
                                    vaRtnValue.push("Y");
                                    vaRtnValue.push(vnMonth);
                                    vaRtnValue.push(vsContTermTypeCode);
                                } else {
                                    vaRtnValue.push("N");
                                    vaRtnValue.push(vnMonth);
                                    vaRtnValue.push(vsContTermTypeCode);
                                }
                            }
                        } else {
                            vaRtnValue.push("Y");
                            vaRtnValue.push(vnMonth);
                            vaRtnValue.push(vsContTermTypeCode);
                        }
                    }
                }
                break;
            default :
                break;
        }
        return vaRtnValue;
    },


    /**
     * 제한소재 체크한다.
     *
     * @param psReqNode : 소재 체크 요청할 param 노드 (각자 화면에 노드를 생성해야함) ex) /root/requestChkMtrl
     * @param psResNode : msg 값 return 받는 노드(각자 화면에 노드를 생성해야함) ex) /root/responseChkMtrl
     * @param poParam : 소재 체크시 필요한 param 값들
     *    poParam.recNo            -- 그리드 row no값 ( 1건 일 경우 0을 보낸다)
     *    poParam.frmNo             -- 편성번호
     *    poParam.brdChgCode       -- 방송변경구분        default(SQD00) , 기본편성(SQD01), 이동편성(SQD02)
     *    poParam.sbscrCrrntCode   -- 청약(가/실)구분     가청약(SHX01), 실청약(SHX02)
     *    poParam.stDate           -- 청약시작일자
     *    poParam.edDate           -- 청약종료일자
     *    poParam.agncyCode        -- 광고회사코드
     *    poParam.agncyOffcCode    -- 광고회사코드
     *    poParam.cliCode          -- 광고주코드
     *    poParam.agntContSeqNo    -- 대행계약일련번호
     *    poParam.agntContBrndSeqNo-- 대행계약품목일련번호
     *    poParam.brndSeqNo        -- 품목일련번호
     *    poParam.repMtrlSeqNo     -- 대표소재일련번호
     *    poParam.mtrlSeqNo        -- 소재일련번호
     *    poParam.mtrlSec          -- 소재초수
     *    poParam.remark           -- 비고메시지  (트리거에서 사용할 것임.)
     * @return boolean : true or false
     */
    checkMtrlLmtTime: function (psReqNode, psResNode, poParam) {
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/recNo", poParam.recNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/frmNo", poParam.frmNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brdChgCode", poParam.brdChgCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/sbscrCrrntCode", poParam.sbscrCrrntCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/stDate", poParam.stDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/edDate", poParam.edDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyCode", poParam.agncyCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyOffcCode", poParam.agncyOffcCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/cliCode", poParam.cliCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agntContSeqNo", poParam.agntContSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agntContBrndSeqNo", poParam.agntContBrndSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brndSeqNo", poParam.brndSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/repMtrlSeqNo", poParam.repMtrlSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mtrlSeqNo", poParam.mtrlSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mtrlSec", poParam.mtrlSec);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/remark", poParam.remark);

        //메세지 초기화
        WebSquare.ModelUtil.setInstanceValue(psResNode + "/rtErr", "");
        WebSquare.ModelUtil.setInstanceValue(psResNode + "/rtConfirm", "");

        //제한 소재 체크 sub send
        if (!METHODIACom.sendCmnCode(psReqNode, psResNode, "/com/CmnCheckMtrl/CmnCheckMtrl.do")) {
            return false;
        }
        var vsErr = WebSquare.ModelUtil.getInstanceValue(psResNode + "/rtErr");
        var vsConfirm = WebSquare.ModelUtil.getInstanceValue(psResNode + "/rtConfirm");

        //err 메시지가 있을 경우 처리할수 없다.
        if (vsErr != "" && vsErr != null && vsErr != undefined) {
            if (poParam.recNo == 0 || poParam.recNo == "0") {
                //MsgBox.show(vsErr);
                alert(vsErr);
                return false;
            } else {
                MsgBox.show("[" + (poParam.recNo) + "] 라인의 소재는 " + vsErr);
                return false;
            }
        }
        //confirm 메시지가 있을경우는 확인창을 띄워 사용자가 결정하게 한다.
        if (vsConfirm != "" && vsConfirm != null && vsConfirm != undefined) {
            var vsYN = vsConfirm.substr(0, 1);
            var vsMsg = vsConfirm.substr(1, vsConfirm.length);
            if (vsYN == "Y") {
                if (poParam.recNo == 0 || poParam.recNo == "0") {
                    alert(vsMsg + "\n\n 주의해 주세요!!!!! ");
                } else {
                    alert("[" + (poParam.recNo) + "] 라인의 소재는 " + vsMsg + "\n\n주의해 주세요!!!!!  ");
                }
            } else if (vsYN == "X") {	// 대행기간체크는 X로 보내서 메시지를 안띄워주고 넘어간다. 아래에서 다시 체크함.
                return true;
            } else {
                if (poParam.recNo == 0 || poParam.recNo == "0") {
                    alert(vsMsg);
                } else {
                    alert("[" + (poParam.recNo) + "] 라인의 소재는 " + vsMsg);
                }
            }
        }
        return true;
    },

    /**
     * 대행기간 체크한다 대행기간 체크후 메시지를 한번 만 뿌려주기 위해서 추가로 생성함.
     *
     * @param psReqNode : 소재 체크 요청할 param 노드 (각자 화면에 노드를 생성해야함) ex) /root/requestChkMtrl
     * @param psResNode : msg 값 return 받는 노드(각자 화면에 노드를 생성해야함) ex) /root/responseChkMtrl
     * @param poParam : 소재 체크시 필요한 param 값들
     *    poParam.recNo            -- 그리드 row no값 ( 1건 일 경우 0을 보낸다)
     *    poParam.frmNo            -- 편성번호
     *    poParam.stDate           -- 청약시작일자
     *    poParam.edDate           -- 청약종료일자
     *    poParam.agncyCode        -- 광고회사코드
     *    poParam.agncyOffcCode    -- 광고회사코드
     *    poParam.cliCode          -- 광고주코드
     *    poParam.agntContSeqNo    -- 대행계약일련번호
     *    poParam.agntContBrndSeqNo-- 대행계약품목일련번호
     * @return      "P" : confirm 창에서 예를 선택할 경우 /
     *              "F" : 오류 또는 실패 /
     *              "N" : confirm 창에서 아니오를 선택할 경우 /
     *              "Y" : confirm메시지 없을 경우 통과 /
     *
     */
    checkAgntLmt: function (psReqNode, psResNode, poParam) {
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/remark", poParam.remark);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/recNo", poParam.recNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/frmNo", poParam.frmNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/stDate", poParam.stDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/edDate", poParam.edDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyCode", poParam.agncyCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyOffcCode", poParam.agncyOffcCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/cliCode", poParam.cliCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agntContSeqNo", poParam.agntContSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agntContBrndSeqNo", poParam.agntContBrndSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/chkMsg", poParam.chkMsg);
        //메세지 초기화
        WebSquare.ModelUtil.setInstanceValue(psResNode + "/remsg", "");

        //제한 소재 체크 sub send
        if (!METHODIACom.sendCmnCode(psReqNode, psResNode, "/com/CmnCheckAgnt/CmnCheckAgnt.do")) {
            return "F";
        }

        var vsConfirm = WebSquare.ModelUtil.getInstanceValue(psResNode + "/remsg");
        var vsChkMsg = WebSquare.ModelUtil.getInstanceValue(psResNode + "/chkMsg");

        //err 메시지가 있을 경우 처리할수 없다.
        //confirm 메시지가 있을경우는 확인창을 띄워 사용자가 결정하게 한다.
        // P ==> 확인메시지에서 예 버튼을 클릭했을 경우 그 다음부터 메시지 띄우지 않음 Pass
        // N ==> 확인메시지에서 아니오 버튼을 클릭했을 경우 소재 선택 안되고 다음으로 넘어감
        // F ==> 실패 또는 오류임
        // Y ==> 확인메시지가 없는 경우
        if (vsConfirm != "" && vsConfirm != null && vsConfirm != undefined) {
            if (vsChkMsg == "P") {
                return "P";
            } else {
                if (vsChkMsg == "N") {
                    return "N";
                } else {
                    var vsYN = vsConfirm.substr(0, 1);
                    var vsMsg = vsConfirm.substr(1, vsConfirm.length);
                    if (vsYN == "Y") {
                        if (poParam.recNo == 0 || poParam.recNo == "0") {
                            alert(vsMsg + "\n\n그래도 처리 하시겠습니까?? ", "방송제한 소재 체크");
                            return "P";
                        } else {
                            alert("[" + poParam.recNo + "] 라인의 소재는 " + vsMsg + "\n\n그래도 처리 하시겠습니까? ", "방송제한 소재 체크");
                            return "P";
                        }
                    } else {
                        if (poParam.recNo == 0 || poParam.recNo == "0") {
                            MsgBox.show(vsMsg);
                            return "P";
                        } else {
                            MsgBox.show("[" + poParam.recNo + "] 라인의 소재는 " + vsMsg);
                            return "P";
                        }
                    }
                }
            }
        }
        return "Y";

    },


    /**
     DMB 청구지변경 임시 소재 체크
     */
    checkMtrlLmtTimeDmb: function (psReqNode, psResNode, poParam) {
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/recNo", poParam.recNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/frmNo", poParam.frmNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brdChgCode", poParam.brdChgCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/sbscrCrrntCode", poParam.sbscrCrrntCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/stDate", poParam.stDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/edDate", poParam.edDate);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyCode", poParam.agncyCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agncyOffcCode", poParam.agncyOffcCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/cliCode", poParam.cliCode);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agntContSeqNo", poParam.agntContSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/agntContBrndSeqNo", poParam.agntContBrndSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/brndSeqNo", poParam.brndSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/repMtrlSeqNo", poParam.repMtrlSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mtrlSeqNo", poParam.mtrlSeqNo);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/mtrlSec", poParam.mtrlSec);
        WebSquare.ModelUtil.setInstanceValue(psReqNode + "/remark", poParam.remark);

        //메세지 초기화
        WebSquare.ModelUtil.setInstanceValue(psResNode + "/rtErr", "");
        WebSquare.ModelUtil.setInstanceValue(psResNode + "/rtConfirm", "");

        //제한 소재 체크 sub send
        if (!METHODIACom.sendCmnCode(psReqNode, psResNode, "/com/CmnCheckMtrl/CmnCheckMtrl.do")) {
            return false;
        }
        var vsErr = WebSquare.ModelUtil.getInstanceValue(psResNode + "/rtErr");
        var vsConfirm = WebSquare.ModelUtil.getInstanceValue(psResNode + "/rtConfirm");

        //DMB청구지변경은 메시지 안띄워 주고 화면단에서 체크하게 한다.
        //err 메시지가 있을 경우 처리할수 없다.
        if (vsErr != "" && vsErr != null && vsErr != undefined) {
            if (poParam.recNo == 0 || poParam.recNo == "0") {
                return false;
            } else {
                return false;
            }
        }
        //confirm 메시지가 있을경우는 확인창을 띄워 사용자가 결정하게 한다.
        if (vsConfirm != "" && vsConfirm != null && vsConfirm != undefined) {
            if (poParam.recNo == 0 || poParam.recNo == "0") {
                return false;
            } else {
                return false;
            }
        }
        return true;

    },
    /**
     필수입력 체크할 그리드와 필수입력 컬럼을 배열로 받아서 체크.
     */
    validateNotNullRpts: function (paGrid, paValidateCol, paValidateColNm) {
        if (paValidateCol != "" && paValidateCol != null) {
            var vnColLen = paValidateCol.length;
            var vnGridCnt = paGrid.getRowCount();
            for (var i = 0; i < vnColLen; i++) {
                var vaValidateList = paGrid.getMatchedIndex(paValidateCol[i], "", true, 0, vnGridCnt);
                if (vaValidateList.length > 0) {
                    ComMsg.error("M002", [paValidateColNm[i]]);
                    rptMain.setFocusedCell(vaValidateList[0], paValidateCol[i], false);
                    return false;
                }
            }
        }

        return true;
    },
    /*--------------------------------------------
    함수		: isValidBizNo
    파라미터	: 사업자등록번호(10)
    리턴		: true/false
    작용		: 입력받은 사업자등록번호의 유효성 체크를 한다.
---------------------------------------------*/
    isValidBizNo: function (psBizNo) {
        //'-'제거해준다.
        psBizNo = psBizNo.replace(/-/g, "");

        if ((psBizNo.length != 10) || (psBizNo == "0000000000") || (psBizNo == null)) {
            return false;
        }

        var sum = 0, list_y, bizNo_chk;
        var list_bizNo = new Array(10);
        var list_chkvalue = [1, 3, 7, 1, 3, 7, 1, 3, 5];

        for (i = 0; i < 10; i++) {
            list_bizNo[i] = psBizNo.substr(i, 1);
        }

        for (i = 0; i < 9; i++) {
            sum += (list_bizNo[i] * list_chkvalue[i]);
        }

        sum += parseInt((list_bizNo[8] * 5) / 10);

        list_y = sum % 10;

        if (list_y == 0) bizNo_chk = 0;
        else bizNo_chk = 10 - list_y;

        if (bizNo_chk == list_bizNo[9]) {
            return true;
        } else {
            return false;
        }
    },
    /*--------------------------------------------
     함수		: isValidJuminNo
     파라미터	: 주민번호앞자리(6),주민번호뒷자리(7)
     리턴		: true/false
     작용		: 입력받은 주민번호의 유효성 체크를 한다.
 ---------------------------------------------*/
    isValidJuminNo: function (psSsn1, psSsn2) {
        var chk = 0;
        var yy = psSsn1.substring(0, 2);
        var mm = psSsn1.substring(2, 4);
        var dd = psSsn1.substring(4, 6);
        var sex = psSsn2.substring(0, 1);

        if (psSsn1.length != 6) {
            return false;
        }
        if ((sex != 1 && sex != 2 && sex != 3 && sex != 4) || (psSsn2.length != 7)) {
            return false;
        }
        if ((psSsn1.length == 6) && (psSsn2.length == 7)) {
            var ich = parseInt(sex, 10);
            switch (ich) {
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    break;
                default:
                    return false;
            }
        }
        for (var i = 0; i <= 5; i++) {
            chk = chk + (((i % 8) + 2) * parseInt(psSsn1.substring(i, i + 1)));
        }
        for (var i = 6; i <= 11; i++) {
            chk = chk + (((i % 8) + 2) * parseInt(psSsn2.substring(i - 6, i - 5)));
        }
        chk = 11 - (chk % 11);
        chk = chk % 10;

        if (chk != psSsn2.substring(6, 7)) {
            return false;
        }
        return true;
    }
};




//사용자 권한 Util
var AuthUtil = {
    /**
     * 렙 영업사원인지 여부
     */
    getUserSale: function () {
        var voPage = METHODIACom.getParentPage();
        var vsCompTypeCode = voPage.getUserInfo("compTypeCode");
        var vsAthrId = voPage.getUserInfo("athrId");
        if (vsCompTypeCode == "SAA01" && (vsAthrId == "POA02" || vsAthrId == "POA03" || vsAthrId == "POA04"
            || vsAthrId == "POA05" || vsAthrId == "POA06" || vsAthrId == "POA01" || vsAthrId == "POA07" || vsAthrId == "POA28" || vsAthrId == "POA29" || vsAthrId == "POA35" || vsAthrId == "POA42")) {
            return true;
        } else {
            return false;
        }
    },

    /**
     * 권한별 매체 정보
     *
     * String   psAuth  얻고자 하는 node
     */
    getMediaAuth: function (psAuth) {

        return METHODIACom.getParentPage().getMediaAuth(psAuth);

        return WebSquare.ModelUtil.getInstanceValue("responseHeader/listHeader/object/" + psNode);
    }
};
// Page End
