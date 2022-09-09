<?php include_once(APPPATH . 'views/admin/includes/helpers_bottom.php'); ?>
<?php do_action('before_js_scripts_render'); ?>
<script src="<?php echo base_url('assets/plugins/app-build/vendor.js?v=' . get_app_version()); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery/jquery-migrate.' . (ENVIRONMENT === 'production' ? 'min.' : '') . 'js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/datatables.min.js?v=' . get_app_version()); ?>"></script>
<script src="<?php echo base_url('assets/plugins/app-build/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-colorpicker.min.js'); ?>"></script>
<?php app_select_plugin_js($locale); ?>
<script src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js?v=' . get_app_version()); ?>"></script>
<?php app_jquery_validation_plugin_js($locale); ?>
<?php if (get_option('dropbox_app_key') != '') { ?>
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="<?php echo get_option('dropbox_app_key'); ?>"></script>
<?php } ?>
<?php if (isset($media_assets)) { ?>
    <script src="<?php echo base_url('assets/plugins/elFinder/js/elfinder.min.js'); ?>"></script>
    <?php if (file_exists(FCPATH . 'assets/plugins/elFinder/js/i18n/elfinder.' . get_media_locale($locale) . '.js') && get_media_locale($locale) != 'en') { ?>
        <script src="<?php echo base_url('assets/plugins/elFinder/js/i18n/elfinder.' . get_media_locale($locale) . '.js'); ?>"></script>
    <?php } ?>
<?php } ?>
<?php if (isset($projects_assets)) { ?>
    <script src="<?php echo base_url('assets/plugins/jquery-comments/js/jquery-comments.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/gantt/js/jquery.fn.gantt.min.js'); ?>"></script>
<?php } ?>
<?php if (isset($circle_progress_asset)) { ?>
    <script src="<?php echo base_url('assets/plugins/jquery-circle-progress/circle-progress.min.js'); ?>"></script>
<?php } ?>
<?php if (isset($calendar_assets)) { ?>
    <script src="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.min.js?v=' . get_app_version()); ?>"></script>
    <?php if (get_option('google_api_key') != '') { ?>
        <script src="<?php echo base_url('assets/plugins/fullcalendar/gcal.min.js'); ?>"></script>
    <?php } ?>
    <?php if (file_exists(FCPATH . 'assets/plugins/fullcalendar/locale/' . $locale . '.js') && $locale != 'en') { ?>
        <script src="<?php echo base_url('assets/plugins/fullcalendar/locale/' . $locale . '.js'); ?>"></script>
    <?php } ?>
<?php } ?>
<?php echo app_script('assets/js', 'main.js'); ?>
<?php
/**
 * Global function for custom field of type hyperlink
 */
echo get_custom_fields_hyperlink_js_function();
?>
<?php
/**
 * Check for any alerts stored in session
 */
app_js_alerts();
?>
<?php
/**
 * Check pusher real time notifications
 */
if (get_option('pusher_realtime_notifications') == 1) {
    ?>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script type="text/javascript">
        $(function () {
            // Enable pusher logging - don't include this in production
            // Pusher.logToConsole = true;
    <?php
    $pusher_options = do_action('pusher_options', array());
    if (!isset($pusher_options['cluster']) && get_option('pusher_cluster') != '') {
        $pusher_options['cluster'] = get_option('pusher_cluster');
    }
    ?>
            var pusher_options = <?php echo json_encode($pusher_options); ?>;
            var pusher = new Pusher("<?php echo get_option('pusher_app_key'); ?>", pusher_options);
            var channel = pusher.subscribe('notifications-channel-<?php echo get_staff_user_id(); ?>');
            channel.bind('notification', function (data) {
                fetch_notifications();
            });
        });
    </script>
<?php } ?>
<?php
/**
 * End users can inject any javascript/jquery code after all js is executed
 */
do_action('after_js_scripts_render');

?>
<script>
    /*$(document).ready(function(){
        var url = "<?php echo base_url(); ?>admin/settings/get_notification_count";
        $(".ttl_unread_approval").load(url);
        setInterval(function() {
            $(".ttl_unread_approval").load(url);
        }, 60000);
    });*/


   /*function executeQuery() {
        $.ajax({
            url: "<?php echo base_url(); ?>admin/settings/get_notification_count",
            success: 
            function(response){
                if(response != ''){
                    const obj = JSON.parse(response);
                    $(".ttl_unread_approval").html(obj.approval_count);
                }
            },
        });
        setTimeout(executeQuery, 50000); // you could choose not to continue on failure...
    }

    $(document).ready(function() {
        // run the first time; all subsequent calls will take care of themselves
        setTimeout(executeQuery, 50000);
    });*/

    /*$(document).ready(function(){
        sendRequest();
        function sendRequest(){
            $.ajax({
                url: "<?php echo base_url(); ?>admin/settings/get_notification_count",
                success: 
                function(response){
                    if(response != ''){
                        const obj = JSON.parse(response);
                        $(".ttl_unread_approval").html(obj.approval_count);
                    }
                },
                complete: function() {
                    // Schedule the next request when the current one's complete
                    setInterval(sendRequest, 30000); // The interval set to 10 seconds
                }
            });
        };
    });*/
</script>