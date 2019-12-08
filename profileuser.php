<div class="modal fade"  id="Profile<?php echo $row['username']?>" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin user</h4>
            </div>
            <div class="modal-body" >
                <div class="card">
                <table class="table table-responsive-sm table-hover table-outline mb-0">
                <thead class="thead-light">
            <tr>
                <th class="text-center">
                    <i class="icon-people"></i>
                </th>

                <th class="text-center">Username</th>
                <th class="text-center">Ngày Tạo</th>  
                <th class="text-center">Ngày sinh</th>
                <th class="text-center">Số điện thoại</th>
                <th class="text-center">Số lượng bài đăng</th>
            </tr>
        </thead>
        <tbody>
                
        <?php 
             $_username=$row['username'];
             $sql="select user_table.username,DATE_FORMAT(ngaytao, '%d/%m/%Y') ngaytao,slbai,
             hoten,DATE_FORMAT(ngaysinh, '%d/%m/%Y') ngaysinh,sdt,ava from user_table 
             left join (select username,count(*) slbai from review_table group by username) as a 
             on user_table.username=a.username where a.username='$_username'";
             $result_profile=$conn->query($sql);  
            while ($row2=mysqli_fetch_assoc($result_profile)){ ?>          
            <tr>
                <td  class="text-center" width="80">
                    <div class="avatar">
                    <img class="img-avatar" src="android/avatar/<?php echo $row2['ava']?>" style="width:35px;height:35px;" alt="admin@bootstrapmaster.com">
                    <span class="avatar-status badge-success"></span>
                    </div>
                </td>
            
                <td  class="text-center" width="80">
                    <div><?php echo $_username?></div>
                    <div class="small text-muted">
                    <?php echo $row2['hoten']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row2['ngaytao']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row2['ngaysinh']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row2['sdt']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row2['slbai']?></div>
                </td>
            </tr>
                                        
        <?php }?>               
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
