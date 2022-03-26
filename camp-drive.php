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
        <div class="col-12 col-lg-5 order-lg-1 order-2 text-center">
            <div class="jumbotron bg-white px-0 mb-0 pb-0">
                <picture>
                    <img class="img-fluid rounded mx-auto" style="object-fit:cover;" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_200.jpg 200w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_464.jpg 464w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_664.jpg 664w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_879.jpg 879w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_1037.jpg 1037w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_1185.jpg 1185w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_1347.jpg 1347w,
                    <?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_1400.jpg 1400w" src="<?php print content_url('uploads/camp-drive-assets/images/backpack-hero/'); ?>backpack-banner_uncwzr_c_scale,w_1400.jpg 1400w" alt="Happy kids with backpacks">
                </picture>
            </div>
        </div>
        <div class="col-12 col-lg-7 order-lg-2 order-1 justify-center align-middle" style="display: flex;justify-content: center;align-content: center;">
            <div class="jumbotron bg-white px-0 mb-0 pb-0">
                <div style="display: flex;justify-content: center;align-content: center;flex-direction: column;" class="bg-white inline justify-center align-middle">
                    <h1 style="height: min-content;background-color: lightgray;border-radius: 3px;padding: 4.75rem 0.25em;" class="my-0 text-uppercase bg-gray text-center">
                        <div style="white-space:nowrap;" class="h3 bd-hero-h3 display-1 py-0 my-0">Alternative Family Services</div>
                        <div class="h1 bd-hero-h1 display-3 text-uppercase pt-0 mt-0">YOUTH IN CARE EDUCATION DRIVE</div>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-10 mb-4 mx-auto mt-4">
            <p class="lead">A virtual back-to-school drive to ensure that youth in foster care are fully equipped with the tools and resources necessary for an equitable education.</p>
        </div>
    </div>

    <!-- Tag select row -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header text-center" style="font-size:3rem;">Choose an age group to donate</h5>
                <div class="card-body row" id="button-row">
                    <div class="col-4 text-center" id="camp-tag-container">
                        <button id="camp-tag-button" class="mx-auto">
                            <img class="img-fluid img-thumbnail" style="object-fit:cover;max-height:100px;" src="<?php print content_url('uploads/camp-drive-assets/images/pack-blue.png'); ?>" alt="Present for 0-6">
                            <div class="tt-button-label">Age 0-6</div>
                        </button class="button">
                    </div>
                </div>
                <div class="carbody row">
                    <div class="col-12">
                        <hr class="mx-4 mb-0">
                    </div>
                </div>
                <div class="card-body row pt-0">
                    <div class="col-12">
                        <h3 style="color:#db680c;">A Virtual Back-to-School Drive for Youth in Care</h3>
                        <ul>
                            <li>
                                Individuals, community organizations (churches, community groups) and businesses can support a youth in care by donating funds, backpacks, and school supplies.
                            </li>
                            <li>There is no limit to how many tags you can fulfill.</li>
                            <li>Share this webpage with your network and on social media.</li>
                            <li>Questions can be emailed to Director of Development, Simone West - <a href="mailto:swest@afs4kids.org" target="_blank">swest@afs4kids.org</a>.</li>
                        </ul>
                        <h3 style="color:#db680c;">Adopt a Tag</h3>
                        <ol>
                            <li>Choose age group you’d like to adopt a tag for.</li>
                            <li>Click "new tag" to browse requests. Hitting the back-arrow starts the tag search over.</li>
                            <li>
                                Once you choose a tag, select:<br /><em>Donate Money for Supplies</em><br />OR<br /><em>Buy & Ship Supplies</em><br />
                                Purchase the requested item from the tag from any online retailer and ship to:<br />
                                <span style="font-weight:bold;">AFS Development Department, 401 Roland Way #150, Oakland, CA 94621</span>
                            </li>
                        </ol>
                        <div class="tt-oj-sub-item">
                            <h3 style="color:#db680c;">Donate Directly to the AFS Foster Learning Fund</h3>
                            <ul>
                                <li>
                                    Funds will be used for the highest educational priorities for foster youth.<br />
                                    <em>Examples of how your donation may be used to foster learning with AFS clients:</em><br />
                                    $5,000 - Tuition support for two Transition Age Youth (TAY)<br />
                                    $1,000 - Tutoring expenses for one Youth <br />
                                    $500 - Laptop/Chromebook for school <br />
                                    $250 - School clothes/shoes for two Youth <br />
                                    $100 - New backpacks for three Youth <br />
                                    $75 - Haircare kit for Black Youth <br />
                                    $50 - School supplies for one Youth
                                </li>
                            </ul>
                            <a class="btn btn-lg btn-danger btn-afsOrange mx-auto mb-4" style="margin-left:2.75em;" href="https://alternativefamilyservices.humanitru.com/donate?page=foster-learning&amount=50&options=100%2C75%2C25%2C10&tribute=true&ach=true&address=optional" target="_blank" rel="noopener">Donate</a>
                        </div>
                        <div class="tt-oj-sub-item">
                            <h3 style="color:#db680c;">Buy and Ship Items from the <a href="https://www.amazon.com/hz/wishlist/ls/1MLYBQK7GDURZ/ref=nav_wishlist_lists_1?_encoding=UTF8&type=wishlist&pldnSite=1" rel="noopener" target="_blank">Youth in Care Wishlist</a></h3>
                            <ul>
                                <li>Instead of “Adopting a Tag” or donating money, you may choose to purchase and ship any items from the <a href="https://www.amazon.com/hz/wishlist/ls/1MLYBQK7GDURZ/ref=nav_wishlist_lists_1?_encoding=UTF8&type=wishlist&pldnSite=1" target="_blank" rel="noopener">Youth in Care Wishlist</a></li>
                                <li>AFS receives 0.5% of the proceeds from items purchased from AmazonSmile.</li>
                            </ul>
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