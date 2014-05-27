<div id="content">
                     <article>
                        <h2 class="ticket-heading">DANH SÁCH ĐỘI BÓNG</h2>
                        <div id="ticket-titles">
                           <ul>
                              <li class="fixture-title">Tên đội</li>
                              <li class="on-sale-soon-title">Cáp kèo</li>
                              <li class="now-selling-title">Gia nhập</li>
                           </ul>
                        </div>
						<?php 
						foreach($list as $team)
						{
						?>
                        <div class="ticket-holder">
                           <div class="ticket-info">
                              <div class="fixture-ticket-info">
                                 <div class="crest">
                                    <figure>
									<?php 
									if(file_exists(PATH_FOLDER.ROT_DIR.'file/uploads/teams/'.$team['logo']) && is_file(PATH_FOLDER.ROT_DIR.'file/uploads/teams/'.$team['logo']) && $team['logo']!='')
									{
										
									
									?>
									<img src="<?php echo base_url();?>file/uploads/teams/<?php echo $team['logo']?>" />
									<?php } else {?>
									<img src="<?php echo base_url();?>file/uploads/no_image.gif" />
									<?php } ?>
									</figure>
                                 </div>
                                 <!--/crest -->
                                 <div class="match-info">
                                    <h3>
                                       <a href="/match/report/1314/tickets/first-team/fa-cup-final-ticket-policy" ><?php echo $team['name']?></a>
                                    </h3>
                                    
                                   <div class="link-list">
                        <ul>
                           <a href="http://www.alwaysaheadofthegame.com ">Thành viên</a>
						   <a href="http://www.alwaysaheadofthegame.com ">Kết quả các trận đấu gần đây</a>
                        </ul>
                     </div>
									
                                 </div>
                                 <!--/match-info -->
                              </div>
                              <!--/fixture-ticket-info -->
                              <div class="sale-info">
                                 <div class="on-sale">
                                 <?php 
                                 if(!$this->tank_auth->is_logged_in())
                                 {
								 	?>
								 	<a id="login-capkeo" href="#" class="red-btn buy-now" style="width:105px !important;"><span>Cáp kèo</span></a>
                                 </div>
                                 <!--/on-sale -->
                                 <div class="now-selling">
                                    <a id="login-gianhap" href="#" class="red-btn buy-now" style="width:105px !important;"><span>Gia nhập</span></a>
                                 </div>
								 	<?php
								 }
								 else
								 {
								 
                                 ?>
								 <a  href="#" class="red-btn buy-now" style="width:105px !important;"><span>Cáp kèo</span></a>
                                 </div>
                                 <!--/on-sale -->
                                 <div class="now-selling">
                                    <a  href="#" class="red-btn buy-now" style="width:105px !important;"><span>Gia nhập</span></a>
                                 </div>
                                 <?php } ?>
                                 <!--/now-selling -->
                              </div>
                              <!--/sale-info -->
                           </div>
                           <!--/ticket-info -->
                           
                        </div>
                        <?php } ?>
                        <!--/ticket-holder -->
                        <div id="ticket-footer"></div>
                        
                        <!--/link-list slice -->
                       
                        <!--/image-small slice -->
                     </article>
                     <div class="ad-holder">
                        <div id="div-gpt-ad-1353671982241-20" class="medium-only ad-wide" style="width:434px; height:208px;" data-attr-pushdown="0"></div>
                     </div>
                  </div>