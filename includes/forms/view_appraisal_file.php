<div class="pd-20 card-box" >
    <?php
    $appraisal_files = appraisal_files($_GET['loan_id']);
    if($appraisal_files[0]['fileName'] !=""){ ?>
        <div class="col-md-55">
            <div class="thumbnail" style="border-radius: 0.08rem">
                <div class="image view view-first">
                    <a href="../includes/file_uploads/loan_officers/<?php echo $appraisal_files[0]['fileName'] ?>"><img style="height: 150px" src="../includes/file_uploads/loan_officers/excel.png"></a>
                    <div class="mask no-caption"></div>
                </div>
                <div class="caption">
                    <p><?php echo current(explode('.', $appraisal_files[0]['fileName'])) ?></p>
                    <p><strong><a name="downloadfile" download="<?php echo $appraisal_files[0]['fileName'] ?>" href="../includes/file_uploads/loan_officers/<?php echo $appraisal_files[0]['fileName'] ?>" style="color: black;">Download</a></strong>
                        <!--                                                    <p>--><?php //echo current(explode('.', $appraisal_files[0]['fileName'])) ?><!--</p>-->
                    </p>
                </div>
            </div>
        </div>
    <?php }?>
</div>