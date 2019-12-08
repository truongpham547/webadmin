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
        <?php while ($row=mysqli_fetch_assoc($data)){ ?>          
            <tr>
                <td  class="text-center" width="80">
                    <div class="avatar">
                    <img class="img-avatar" src="android/avatar/<?php echo $row['ava']?>" style="width:35px;height:35px;" alt="admin@bootstrapmaster.com">
                    <span class="avatar-status badge-success"></span>
                    </div>
                </td>
            
                <td  class="text-center" width="80">
                    <div><?php echo $row['username']?></div>
                    <div class="small text-muted">
                    <?php echo $row['hoten']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row['ngaytao']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row['ngaysinh']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row['sdt']?></div>
                </td>
                <td  class="text-center" width="80">
                    <div><?php echo $row['slbai']?></div>
                </td>
            </tr>
                                        
        <?php }?>               
        </tbody>
    </table>
</div>
               