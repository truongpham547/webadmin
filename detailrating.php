
<div class="modal fade"  id="DetailRating<?php echo $row['id']?>" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết các bài đánh giá</h4>
            </div>
            <div class="modal-body" >
                <div class="card">
                <table class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">ID Bài Viết</th>
                            <th class="text-center"> <i class="icon-people"></i></th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Ngày đăng</th>
                            <th class="text-center">Nội dung</th>
                            <th class="text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                             $idr=$row['id'];
                             $sql="select user_table.username,hoten,ava,rate_table.idreview,DATE_FORMAT(ngaydang, '%d/%m/%Y') ngaydang,noidung,rating 
                             from rate_table INNER JOIN user_table on rate_table.username=user_table.username where idreview='$idr' order by ngaydang desc";
                             $result_rating=$conn->query($sql);  
                             while ($row1=mysqli_fetch_assoc($result_rating))
                             {
                        ?>
                            
                            <tr>
                                <td class="text-center">
                                    <div><?php echo $row['id']?></div>
                                </td>
                                <td class="text-center">
                                    <div class="avatar">
                                    <img class="img-avatar" src="android/avatar/<?php echo $row1['ava']?>" style="width:35px;height:35px;" alt="admin@bootstrapmaster.com">
                                    <span class="avatar-status badge-success"></span>
                                    </div>
                                </td>
                                
                                <td class="text-center">
                                    <div><?php echo $row1['username']?></div>
                                    <div class="small text-muted">
                                    <?php echo $row1['hoten']?></div>
                                </td>
                                <td class="text-center">
                                    <div><?php echo $row1['ngaydang']?></div>
                                </td>
                                <td class="text-center">
                                    <div><?php echo $row1['noidung']?></div>
                                </td>
                                <td class="text-center">
                                    <strong><?php echo $row1['rating']?></strong>
                                    </td>
                            </tr>
                            
                             <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer" align="center">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
                
    </div>
</div>
