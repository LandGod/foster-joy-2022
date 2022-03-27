<?php /* Template Name: CampDrive */ ?>
<?php get_header(); ?>

<script>
    // Add assets url path to global scope for our JS to use for loading files
    window.campDriveAssetsURL = "<?php print content_url('uploads/camp-drive-assets/'); ?>";
    window.siteURL = "<?php print get_site_url() ?>"
</script>

<style>
    /* We can't do this in the main css file since it uses PHP to get the file path */
    .tt-tag-main {
        background: url(<?php print content_url('uploads/camp-drive-assets/images/tagimage.png'); ?>);
        background-repeat: no-repeat;
        background-size: 600px 300px;
        background-position: center;
    }
</style>

<div class="container mt-2" style="position: relative;">
    <!-- Header row with hero image -->
    <div class="row">
        <div class="col-12 order-lg-1 order-2 text-center">
            <div class="jumbotron bg-white px-0 mb-0 pb-0">
                <picture>
                    <img class="img-fluid rounded mx-auto" style="object-fit:cover;" sizes="(max-width: 799px) 100vw, 799px" srcset="
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_200.png 200w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_311.png 311w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_402.png 402w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_477.png 477w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_546.png 546w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_611.png 611w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_671.png 671w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_731.png 731w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_787.png 787w,
                    <?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_799.png 799w" src="<?php print content_url('uploads/camp-drive-assets/images/header/'); ?>foster-hope-camps-header_t03djg_c_scale,w_799.png" alt="Happy kid at camp with marshmallow">
                </picture>
            </div>
        </div>
    </div>
    <!-- Tag select row -->
    <div class="row mb-5">
        <div class="col-12 justify-content-center">
            <div class="">
                <div class="card-body row justify-content-center" id="button-row">
                    <div class="col-11 col-md-4 text-center" id="camp-tag-container">
                        <button id="camp-tag-button" class="mx-auto tt-camp-tag-button" >
                            <div class="tt-button-label" style="color:black;">
                                <div class="font-weight-bold">Click Here</div>
                                <div>to select a wishtag and fulfill a foster youth's enrichment opportunity</div>
                            </div>
                        </button class="button">
                    </div>
                </div>
                <div class="card-body row pt-0 justify-content-center">
                    <div class="col-12 col-md-10 px-5 tt-post-content justify-content-center">
                        <?php
                        // Calling get_post with no argument returns the post "object" for the current context (which in this case is this page)
                        $post = get_post();
                        // Calling get_post_content with on the post object returns just the text of the post (ie: what you put in the main text field of the CMS)
                        // The post object is the third argument. Not sure what the first 2 args do, but we don't need them, so passing null for both.
                        $content = get_the_content(null, null, $post);
                        ?>
                        <div>
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php get_footer(); ?>



    <?php
    /*
// List of toys
// Each toy name should exactly correspond with an existing image
$toyList = array("truck", "rocking_horse", "doll");
$toy = $toyList[rand(0, count($toyList) - 1)];
$toyPicturesFolder = ;
$toySrc = $toyPicturesFolder . $toy . ".jpg";

// List of names with genders
$nameGenderPairs = file_get_contents(content_url('uploads/camp-drive-assets/humanChildren.json'));
$realHumanChildren = json_decode($nameGenderPairs);
$randomNumber = rand(0, count($realHumanChildren) - 1);
$name = $realHumanChildren[$randomNumber][0];
$gender = strcmp($realHumanChildren[$randomNumber][1], 'm') == 0 ? 'Boy' : "Girl";
$pronoun = strcmp($gender, 'Boy') == 0 ? 'him' : 'her';
$printableToy = str_replace("_", " ", $toy);
*/
    ?>