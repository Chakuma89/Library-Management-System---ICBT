<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom/popup.css">

<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ajaxupload/ajaxupload.3.5.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        uploadBulk();
    });
</script>


<div class="modal-dialog size-50">
    <div class="modal-content popup">
        <div class="modal-header">
            <button type="button" class="p-close" data-dismiss="modal" aria-label="Close">
                <span>
                    <svg version="1.1" id="Layer_1" x="0px" y="0px" width="15px" height="15px" viewBox="2.5 2.5 15 15">
                    <g>
                    <g>
                    <path d="M17.373,3.471l-0.845-0.842L10,9.159l-6.529-6.53L2.628,3.471l6.529,6.53l-6.529,6.528l0.842,0.842
                           L10,10.844l6.529,6.527l0.844-0.84l-6.53-6.53L17.373,3.471z"/>
                    </g>
                    </g>
                    </svg>
                </span>
            </button>
            <h4 class="modal-title">Variable Addition Bulk Upload</h4>  
        </div>

        <div class="modal-body m-body">

            <div class="row">
                <div class="col-lg-4">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/uploads/bulkSample/sampleVariableAddition.xls"  
                       title="">
                        <h6 class="title">
                            <i class="xls-file"></i>
                            <span>Sample Excel</span>
                        </h6>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="input-box">
                        <div class="regi-uploaded-image">
                            <div id="files">
                            </div>
                        </div>

                        <div class="image-upload-but">
                            <span id="status" class="upload-img"> </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button id="upload" class="but upload" onclick="uploadBulk();">
                        <span></span>
                        Upload
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="message success" id="success-note" style="display: none"></div>  
                </div>
            </div>
        </div>

    </div>

</div>
<script type="text/javascript">

</script>