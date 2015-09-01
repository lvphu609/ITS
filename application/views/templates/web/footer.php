</div>
            </div>
            <!--end page-wraper-->
        </div>
        <!--end container-->

        <!-- jQuery -->
        <script src="<?php echo base_url('resources/includes/sb2/bower_components/jquery/dist/jquery.min.js'); ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('resources/includes/sb2/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('resources/js/jquery.validate.min.js'); ?>"></script>


        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('resources/includes/sb2/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('resources/includes/sb2/dist/js/sb-admin-2.js'); ?>"></script>

        <?php
        if(isset($js_file) && count($js_file)){
            foreach($js_file as $file)
                echo '<script type="text/javascript" src="'.base_url("resources/".$file).'"></script>';
        }
        ?>

        <?php
            if(isset($js_file_module) && count($js_file_module)){
                foreach($js_file_module as $file)
                    echo '<script type="text/javascript" src="'.base_url("modules/".$file).'"></script>';
        }
        ?>

        <footer>
                <div class="col-lg-10 col-lg-offset-1 text-center">
                  <!--  <div class="footer-div"></div>-->
                    <!--<ul class="list-inline text-center">
                        <li>
                            <a href="#">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                            </a>
                        </li>
                    </ul>-->
                    <hr class="small">
                    <p class="text-muted">Copyright © X-Project 2015</p>
                </div>
        </footer>

    </body>
</html>