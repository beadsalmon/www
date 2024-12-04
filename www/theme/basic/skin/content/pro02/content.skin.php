<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>



<div class="content">
    
    <div class="scene-1">
        <div class="cont_wrap">
            <div class="inner">
                
                <div class="sub_txt">
                    <div></div>
                </div>
                
                <div class="main_txt">
                    <div><img src="/theme/basic/img/main/plogo02.png" /></div>
                    <div>
                      <h5>Pitching Trajectory Analysis System</h5>
                      <p>PiTAS는 야구경기에서 투수가 던지는 공의 궤적 및 디테일한 정보를 분석 및 저장하여 투구폼 개선에 도움을 주는 실시간 데이터 검출 시스템입니다.</p>
                    </div>
                    <div>
                      <ul>
                        <li><span>투구 실시간 검출</span></li>
                        <li><span>투구 영상 촬영</span></li>
                        <li><span>저장된 투구 영상 검출</span></li>
                        <li><span>3D 투구 궤적 생성 및 다양한 정보 추출</span></li>
                      </ul>
                    </div>
                </div>
                
            </div>
        </div>
                        
        <div class="number_case">
            <div class="inner"></div>
        </div>

    </div>
    
    
    <div class="scene-2">
        <div class="cont_wrap">
            <div class="inner">
                
                <div class="main_txt">
                    <div><video src="https://d1amy54h6wknr5.cloudfront.net/labinno_web/img/pitas.mp4" autoplay="false" playsinline style="width:100%;" controls id="pitas-video"></video></div>
                </div>
                
            </div>
        </div>
    </div>

    
</div>

