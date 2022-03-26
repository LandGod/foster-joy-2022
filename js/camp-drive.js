async function tagTreeMain() {
  // Setup hooks for our 3 age group buttons:
  const buttonContainer = document.getElementById("camp-tag-container");

  // Hold all actual tag elements
  let tagElementActual = null;
  // Track currently displayed tag
  window.currentTag = null;
  // Our click-off handler will always trigger after our add-tag handler due to bubbling
  // So we set this to true every time we add a tag, and then click-off will abort (an then reset it to false)
  window.tagAddSwitch = false;

  const buttonRow = document.getElementById("button-row");
  const mainButton = document.getElementById("camp-tag-button");

  // See backpack-drive.php for declaration of campDriveAssetsURL
  const rawProfiles = await fetch(campDriveAssetsURL + "camps.json");
  const profilesList = await rawProfiles.json();

  const rawNameFile = await fetch(
    campDriveAssetsURL + "humanChildren.json"
  );
  const namesList = await rawNameFile.json();

  const GENDERS = {
    b: "boy",
    g: "girl",
    0: "boy",
    1: "girl",
    m: "boy",
    f: "girl",
  };

  const confirmationBaseULR =
    window.siteURL + "/education-drive-confirmation-page/";
  const donationLink =
    "https://alternativefamilyservices.humanitru.com/donate?page=foster-learning&amount=50&options=100%2C75%2C25%2C10&tribute=true&ach=true&address=optional";

  // Return random number between 0 and n
  function rand(n) {
    n = Number(n);
    return parseInt(Math.floor(Math.random() * (n + 1)));
  }

  function randChar() {
    let ordinal = rand(25);
    let unicode = ordinal + 0x61;
    return String.fromCharCode(unicode);
  }

  let tag = {};

  function reGenerateTagData() {
    // Select random entry from all camps (keeping it as 'toy' cuz I'm lazy, but it's the camp/activity.)
    tag.toy = profilesList[rand(profilesList.length - 1)];

    // Pick from 2 genders since our names are already categorized that way
    const gender = GENDERS[rand(1)];

    // Pick names at random until one comes up matching the gender we picked
    while (true) {
      let tempName = namesList[rand(namesList.length - 1)];
      if (GENDERS[tempName[1]] === gender) {
        tag.name = tempName[0];
        break;
      }
    }

    // Make up an age for a teen. returns number between 12 and 17 inclusive... probably. (I'm not good at math)
    tag.age = 12 + rand(5);

    // Pick initial for surname
    tag.initial = randChar().toUpperCase();
  }

  // Roll initial tags
  // They will be re-rolled every time we remove a tag from the DOM
  reGenerateTagData();

  function generateTag() {
    let newTagElement = document.createElement("div");
    newTagElement.classList.add("tt-tag");
    newTagElement.classList.add("tt-tag-main");
    newTagElement.dataset.group = "1";

    let tagText = document.createElement("div");
    tagText.classList.add("tt-tag");
    tagText.classList.add("tt-tag-text");
    tagText.innerHTML = `
        <p class="tt-tag tt-tag-name">
          ${tag.name} ${tag.initial}.
        </p>
        <p class="tt-tag tt-tag-age">Age ${tag.age}</p>
        <p class="tt-tag tt-tag-toy">Wants donation for ${tag.toy}</p>
        <div class="tt-tag tt-tag-buttons"> 
            <a class="tt-tag btn btn-danger btn-afsOrange" href="${donationLink}?kidname=${
      tag.name
    }+${tag.initial}&toy=${encodeURIComponent(tag.toy)}&age=${
      tag.age
    }">Donate Money for this activity</a>
            <button class="tt-tag btn btn-danger btn-afsOrange re-roll-button" data-group="${1}">New tag</button>
        </div>
        
        <div class="tt-tag tt-tag-buttons-small"> 
            <a 
              class="tt-tag btn btn-sm btn-danger btn-afsOrange" 
              href="${confirmationBaseULR}?kidname=${tag.name}+${
      tag.initial
    }&toy=${encodeURIComponent(tag.toy)}&age=${tag.age}"
            >
              Buy Item
            </a>
            <a class="tt-tag btn btn-sm btn-danger btn-afsOrange" href="${donationLink}" rel="noopener noreferrer">Donate Money for Supplies</a>
            <button class="tt-tag btn btn-sm btn-danger btn-afsOrange re-roll-button" data-group="${1}">New tag</button>
        </div>
    `;

    newTagElement.append(tagText);

    return newTagElement;
  }

  // Add the tag to the DOM
  function addTagToDOM(noClickOff = false) {
    // Remove any existing tag from DOM
    if (window.currentTag) window.currentTag.remove();
    window.currentTag = tagElementActual;
    buttonRow.append(tagElementActual);
    // Pass true to second argument to prevent setting window.tagAddSwitch to true
    // You'll want to do this if regenerating without clicking off
    window.tagAddSwitch = noClickOff ? false : true;
    // Set event listener for re-rolling the tag in place
    tagElementActual.addEventListener("click", (ev) => {
      tagElementActual.remove();
      reGenerateTagData();
      tagElementActual = generateTag();
      addTagToDOM(true);
    });
  }

  // Generate new tag & store it (this used to be an array, so it might be a bit redundant at this point, but I have a headache, so whatever)
  tagElementActual = generateTag();
  // Create trigger for adding tag to dom when corresponding button is clicked
  mainButton.addEventListener("click", () => {
    addTagToDOM();
  });

  // Listener for "click-off" of tags
  document.addEventListener("click", (ev) => {
    window.tagElementActual = tagElementActual; // just for testing
    if (ev && ev.target && !isTag(ev.target)) {
      if (!window.currentTag || window.tagAddSwitch) {
        window.tagAddSwitch = false;
        return;
      }
      let tagNum = Number(window.currentTag.dataset.group);
      window.currentTag.remove();
      window.currentTag = null;
      reGenerateTagData();
      tagElementActual = generateTag();
    }
  });

  function isTag(elem) {
    if (!elem || !elem.classList) return false;
    if (elem.classList.contains("tt-tag")) return true;
    return false;
  }
}

// Run code when document is loaded
if (document.readyState === "complete") tagTreeMain();
else document.addEventListener("DOMContentLoaded", tagTreeMain);
