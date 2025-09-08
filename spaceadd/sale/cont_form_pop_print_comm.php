<?php

$io_img_logo = "https://spaceadd2.cafe24.com/spaceadd/img/io/spaceAdd.png" ;
$io_img_stamp ="https://spaceadd2.cafe24.com/spaceadd/img/io/stamp.png" ;

$sql = "select 
                a.cont_seq,
                a.cont_nm,
                a.cont_type_code,
                a.mda_type,
                a.cont_yearmon,
                a.cont_stat,
                a.cli_seq,  
                (select comp_nm from tb_comp where comp_seq = a.cli_seq) cli_nm ,
                a.agncy_seq,
                (select comp_nm from tb_comp where comp_seq = a.agncy_seq) agncy_nm ,
                a.rep_seq,
                (select comp_nm from tb_comp where comp_seq = a.rep_seq) rep_nm ,
                a.sale_prsn,
                a.cont_st_dt,
                a.cont_ed_dt,
                a.cont_amt,
                a.brnd_nm ,
                a.campgn_nm ,
                a.bigo , 
                (select sum(sell_amt) from tb_cont_fin x where x.cont_seq = a.cont_seq )  tot_sell_amt
                 , b.mb_name
                , b.mb_email 
            from tb_cont a  , g5_member b 
            where cont_seq='{$_GET['cont_seq']}'
              and a.sale_prsn = b.mb_no ";
$cont = sql_fetch($sql);


$cont['cont_terms'] = date('Y.m.d',strtotime($cont['cont_st_dt']))."~".date('Y.m.d',strtotime($cont['cont_ed_dt']));
$today = date('Y년 m월 d일');
$today2 = date('Y- m-d');


//매체사 정보
$sql_m="
 SELECT
     comp_seq,comp_nm,comp_type,mda_type,busi_no,corp_no,rep_nm1,rep_nm2,tel_no,fax_no,zipcode
    ,concat(addr1, ' ', addr2 ) addr
    , addr3 
    ,busi_sts,item
    ,chrg_nm,chrg_no,chrg_email
    ,psrn_nm,psrn_no,psrn_email
    ,fin_nm,fin_no,fin_email
    ,deal_sts_code,deal_ocur_dt,rep_indst_div,bill_type 
FROM
    tb_comp
where comp_type='AAC02'
  and del_yn='N'
  and comp_seq ='{$mda_comp_seq}'";
$comp_mda = sql_fetch($sql_m);
$comp_mda['busi_no'] = preg_replace("/([0-9]{3})([0-9]{2})([0-9]{5})$/", "\\1-\\2-\\3", $comp_mda['busi_no'] );

//광고회사
if( !isset($angcy_comp_seq)  && $angcy_comp_seq  == "" ){
    $angcy_comp_seq = $cont['agncy_seq'] ;
}
$sql_a="
 SELECT
     comp_seq,comp_nm,comp_type,mda_type,busi_no,corp_no,rep_nm1,rep_nm2,tel_no,fax_no,zipcode
    ,concat(addr1, ' ', addr2 ) addr
    , addr3
    ,busi_sts
    ,item
    ,chrg_nm,chrg_no,chrg_email
    ,psrn_nm,psrn_no,psrn_email
    ,fin_nm,fin_no,fin_email
    ,deal_sts_code,deal_ocur_dt,rep_indst_div,bill_type 
FROM
    tb_comp
where comp_type='AAC03'
  and del_yn='N'
  and comp_seq ='{$angcy_comp_seq}'";
$comp_ag = sql_fetch($sql_a);
$comp_ag['busi_no'] = preg_replace("/([0-9]{3})([0-9]{2})([0-9]{5})$/", "\\1-\\2-\\3", $comp_ag['busi_no'] );



//광고주
$cli_comp_seq = $cont['cli_seq'] ;
$sql_c="
 SELECT
     comp_seq,comp_nm,comp_type,mda_type,busi_no,corp_no,rep_nm1,rep_nm2,tel_no,fax_no,zipcode
    ,concat(addr1, ' ', addr2 ) addr
    , addr3
    ,busi_sts
    ,item
    ,chrg_nm,chrg_no,chrg_email
    ,psrn_nm,psrn_no,psrn_email
    ,fin_nm,fin_no,fin_email
    ,deal_sts_code,deal_ocur_dt,rep_indst_div,bill_type 
FROM
    tb_comp
where comp_type='AAC01'
  and del_yn='N'
  and comp_seq ='{$cli_comp_seq}'";

$comp_cl = sql_fetch($sql_c);
$comp_cl['busi_no'] = preg_replace("/([0-9]{3})([0-9]{2})([0-9]{5})$/", "\\1-\\2-\\3", $comp_cl['busi_no'] );

//스페이스애드 정보
$sql_s=" 
 SELECT
     comp_seq,comp_nm,comp_type,mda_type,busi_no,corp_no,rep_nm1,rep_nm2
    ,'02-2088-5054' tel_no
      ,fax_no,zipcode
    ,concat(addr1, ' ', addr2 ) addr
    , addr3 
    ,busi_sts,item
    ,chrg_nm,chrg_no,chrg_email
    ,psrn_nm,psrn_no,psrn_email
    ,fin_nm,fin_no,fin_email
    ,deal_sts_code,deal_ocur_dt,rep_indst_div,bill_type 
FROM
    tb_comp
where comp_seq=100  " ;
$comp_sa = sql_fetch($sql_s);
$comp_sa['busi_no'] = preg_replace("/([0-9]{3})([0-9]{2})([0-9]{5})$/", "\\1-\\2-\\3", $comp_sa['busi_no'] );


//상품 정산
$cont_f = array();
$sql_f="
  select
        b.prod_seq ,
        b.mda_nm , 
        b.ad_adj_type_code ,
        b.ad_amt  sell_amt ,
        c.cont_mda_seq ,  
        b.ad_rt cont_cmms_rt ,
        ifnull(b.ins_cnt, 0) ins_cnt,
        c.account_cnt ,
        c.st_dt ,
        c.ed_dt , 
        c.mtrl_sec ,  
        e.* ,
        x.m1_nm
        , x.m2_nm
        , x.m3_nm
        , x.m4_nm
        , x.m5_nm
        , x.up_mda_seq
        , x.dep
        , x.full_nm 
         
    FROM
        tb_comp a,
        tb_comp_mda b ,
        tb_cont_mda c,  
        tb_code e ,
        vi_media x 
    WHERE
        a.comp_seq = b.comp_seq
    AND b.prod_seq = c.prod_seq 
    and b.mda_seq = x.mda_seq  
    AND e.comm_type_cd ='BAH'
    AND e.bigo1='Y' 
    AND a.del_yn ='N'
    AND b.del_yn ='N'
    AND b.use_yn ='Y'
    and c.cont_mda_seq in ({$_GET['cont_mda_seq']}) "  ;

   $result_f = sql_query($sql_f);
    while($row = sql_fetch_array($result_f)) {
        array_push($cont_f,  $row);
    }
?>