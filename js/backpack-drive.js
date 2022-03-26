async function tagTreeMain() {
  // Setup hooks for our 3 age group buttons:
  const buttonContainer1 = document.getElementById("age-group-container-1");
  const buttonContainer2 = document.getElementById("age-group-container-2");
  const buttonContainer3 = document.getElementById("age-group-container-3");
  const buttonContainerElementHandles = [
    [buttonContainer1, 1],
    [buttonContainer2, 2],
    [buttonContainer3, 3],
  ];
  // Hold all actual tag elements
  const tagElementsActual = [];
  // Track currently displayed tag
  window.currentTag = null;
  // Our click-off handler will always trigger after our add-tag handler due to bubbling
  // So we set this to true every time we add a tag, and then click-off will abort (an then reset it to false)
  window.tagAddSwitch = false;

  const buttonRow = document.getElementById("button-row");
  const button1 = document.getElementById("age-group-button-1");
  const button2 = document.getElementById("age-group-button-2");
  const button3 = document.getElementById("age-group-button-3");

  const tagButtonHandles = [
    [button1, 1],
    [button2, 2],
    [button3, 3],
  ];

  // See backpack-drive.php for declaration of backpackDriveAssetsURL
  const rawProfiles = await fetch(backpackDriveAssetsURL + "profiles.json");
  const profilesList = await rawProfiles.json();

  const rawNameFile = await fetch(backpackDriveAssetsURL + "humanChildren.json");
  const namesList = await rawNameFile.json();

  const GENDERS = {
    b: "boy",
    g: "girl",
    0: "boy",
    1: "girl",
    m: "boy",
    f: "girl",
  };

  const confirmationBaseULR = window.siteURL + "/education-drive-confirmation-page/";
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

  const tags = { 1: {}, 2: {}, 3: {} };
  const AGEGROUPS = {
    1: "tod",
    2: "kid",
    3: "teen",
  };

  function reGenerateTagData() {
    // For each of 3 age groups
    for (let i = 1; i < 4; i++) {
      // Get subset of all profiles based on age group
      let profileAgeSlice = profilesList[AGEGROUPS[i]];
      // Select random entry from age group
      let randomProfile = profileAgeSlice[rand(profileAgeSlice.length - 1)];

      tags[i].toy = randomProfile[2];
      tags[i].age = randomProfile[0];

      let gender = randomProfile[1];
      if (gender !== GENDERS.b && gender !== GENDERS.g)
        gender = GENDERS[rand(1)];
      tags[i].gender = gender;

      // Pick names at random until one of the proper gender is found
      while (true) {
        let tempName = namesList[rand(namesList.length - 1)];
        if (GENDERS[tempName[1]] === gender) {
          tags[i].name = tempName[0];
          break;
        }
      }

      // Pick initial for surname
      tags[i].initial = randChar().toUpperCase();
    }
  }

  // Roll initial tags
  // They will be re-rolled every time we remove a tag from the DOM
  reGenerateTagData();

  function generateTag(group) {
    let ageGroup = "";
    if (group === 1) ageGroup = "Age 0-6";
    else if (group === 2) ageGroup = "Age 7-12";
    else if (group === 3) ageGroup = "Age 13-18";
    else throw new Error("Invalid age group");

    let newTagElement = document.createElement("div");
    newTagElement.classList.add("tt-tag");
    newTagElement.classList.add("tt-tag-main");
    newTagElement.dataset.group = group;

    let tagText = document.createElement("div");
    tagText.classList.add("tt-tag");
    tagText.classList.add("tt-tag-text");
    tagText.innerHTML = `
        <p class="tt-tag tt-tag-name">
          ${tags[group].name} ${tags[group].initial}.
        </p>
        <p class="tt-tag tt-tag-age">Age ${tags[group].age}</p>
        <p class="tt-tag tt-tag-toy">Wants ${tags[group].toy}</p>
        <div class="tt-tag tt-tag-buttons"> 
            <a 
              class="tt-tag btn btn-danger btn-afsOrange" 
              href="${confirmationBaseULR}?kidname=${tags[group].name}+${
      tags[group].initial
    }&toy=${encodeURIComponent(tags[group].toy)}&age=${tags[group].age}"
            >
              Buy Item
            </a>
            <a class="tt-tag btn btn-danger btn-afsOrange" href="${donationLink}" rel="noopener noreferrer">Donate Money for Supplies</a>
            <button class="tt-tag btn btn-danger btn-afsOrange re-roll-button" data-group="${group}">New tag</button>
        </div>
        
        <div class="tt-tag tt-tag-buttons-small"> 
            <a 
              class="tt-tag btn btn-sm btn-danger btn-afsOrange" 
              href="${confirmationBaseULR}?kidname=${tags[group].name}+${
      tags[group].initial
    }&toy=${encodeURIComponent(tags[group].toy)}&age=${tags[group].age}"
            >
              Buy Item
            </a>
            <a class="tt-tag btn btn-sm btn-danger btn-afsOrange" href="${donationLink}" rel="noopener noreferrer">Donate Money for Supplies</a>
            <button class="tt-tag btn btn-sm btn-danger btn-afsOrange re-roll-button" data-group="${group}">New tag</button>
        </div>
    `;

    newTagElement.append(tagText);

    return newTagElement;
  }

  // Add one of the three tags to the DOM
  function addTagToDOM(num, noClickOff = false) {
    // Remove any existing tag from DOM
    if (window.currentTag) window.currentTag.remove();
    window.currentTag = tagElementsActual[num];
    buttonRow.append(tagElementsActual[num]);
    // Pass true to second argument to prevent setting window.tagAddSwitch to true
    // You'll want to do this if regenerating without clicking off
    window.tagAddSwitch = noClickOff ? false : true;
    // Set event listener for re-rolling the tag in place
    Array.from(
      tagElementsActual[num].getElementsByClassName("re-roll-button")
    ).forEach((elem) => {
      elem.addEventListener("click", (ev) => {
        tagElementsActual[num].remove();
        reGenerateTagData();
        tagElementsActual[num] = generateTag(num);
        addTagToDOM(num, true);
      });
    });
  }

  for (let [htmlTag, number] of tagButtonHandles) {
    // Generate new tag & add it to the tag array
    tagElementsActual[number] = generateTag(number);
    // Create trigger for adding tag to dom when corresponding button is clicked
    htmlTag.addEventListener("click", () => {
      addTagToDOM(number);
    });
  }

  // Listener for "click-off" of tags
  document.addEventListener("click", (ev) => {
    window.tagElementsActual = tagElementsActual; // just for testing
    if (ev && ev.target && !isTag(ev.target)) {
      if (!window.currentTag || window.tagAddSwitch) {
        window.tagAddSwitch = false;
        return;
      }
      let tagNum = Number(window.currentTag.dataset.group);
      window.currentTag.remove();
      window.currentTag = null;
      reGenerateTagData();
      tagElementsActual[tagNum] = generateTag(tagNum);
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
