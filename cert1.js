const userName = document.getElementById("name");
const submitBtn = document.getElementById("submitBtn1");
const submitBtn2 = document.getElementById("submitBtn2");
const submitBtn3 = document.getElementById("submitBtn3");
const submitBtn4 = document.getElementById("submitBtn4");
const { PDFDocument,PDFDocument2,PDFDocument3,PDFDocument4, rgb, degrees } = PDFLib;



const capitalize = (str, lower = false) =>
  (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, (match) =>
    match.toUpperCase()
  );

submitBtn.addEventListener("click", () => {
  const val = capitalize(userName.value);
  

  //check if the text is empty or not
  if (val.trim() !== "" && userName.checkValidity()) {
    // console.log(val);
    generatePDF(val);
  } else {
    userName.reportValidity();
  }
});
submitBtn2.addEventListener("click", () => {
  const val = capitalize(userName.value);
  

  //check if the text is empty or not
  if (val.trim() !== "" && userName.checkValidity()) {
    // console.log(val);
    generatePDF2(val);
  } else {
    userName.reportValidity();
  }
});

submitBtn3.addEventListener("click", () => {
  const val = capitalize(userName.value);
  

  //check if the text is empty or not
  if (val.trim() !== "" && userName.checkValidity()) {
    // console.log(val);
    generatePDF3(val);
  } else {
    userName.reportValidity();
  }
});

submitBtn4.addEventListener("click", () => {
  const val = capitalize(userName.value);
  

  //check if the text is empty or not
  if (val.trim() !== "" && userName.checkValidity()) {
    // console.log(val);
    generatePDF4(val);
  } else {
    userName.reportValidity();
  }
});


const generatePDF = async (name) => {
  const existingPdfBytes = await fetch("./cert.pdf").then((res) =>
    res.arrayBuffer()
  );

  // Load a PDFDocument from the existing PDF bytes
  const pdfDoc = await PDFDocument.load(existingPdfBytes);
  pdfDoc.registerFontkit(fontkit);

  //get font
  const fontBytes = await fetch("./Sanchez-Regular.ttf").then((res) =>
    res.arrayBuffer()
  );

  // Embed our custom font in the document
  const SanChezFont = await pdfDoc.embedFont(fontBytes);

  // Get the first page of the document
  const pages = pdfDoc.getPages();
  const firstPage = pages[0];

  // Draw a string of text diagonally across the first page
  firstPage.drawText(name, {
    x: 178,
    y: 630,
    size: 12,
    font: SanChezFont,
    color: rgb(0, 0, 0),
  });

  // Serialize the PDFDocument to bytes (a Uint8Array)
  const pdfBytes = await pdfDoc.save();
  console.log("Done creating");

  // this was for creating uri and showing in iframe

  // const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
  // document.getElementById("pdf").src = pdfDataUri;

  var file = new File(
    [pdfBytes],
    "ITR.pdf",
    {
      type: "application/pdf;charset=utf-8",
    }
  );
 saveAs(file);
};


const generatePDF2 = async (name) => {
  const existingPdfBytes = await fetch("./cert2.pdf").then((res) =>
    res.arrayBuffer()
  );

  // Load a PDFDocument from the existing PDF bytes
  const pdfDoc = await PDFDocument.load(existingPdfBytes);
  pdfDoc.registerFontkit(fontkit);

  //get font
  const fontBytes = await fetch("./Sanchez-Regular.ttf").then((res) =>
    res.arrayBuffer()
  );

  // Embed our custom font in the document
  const SanChezFont = await pdfDoc.embedFont(fontBytes);

  // Get the first page of the document
  const pages = pdfDoc.getPages();
  const firstPage = pages[0];

  // Draw a string of text diagonally across the first page
  firstPage.drawText(name, {
    x: 110,
    y: 730,
    size: 12,
    font: SanChezFont,
    color: rgb(0, 0, 0),
   
  });

  // Serialize the PDFDocument to bytes (a Uint8Array)
  const pdfBytes = await pdfDoc.save();
  console.log("Done creating");

  // this was for creating uri and showing in iframe

  // const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
  // document.getElementById("pdf").src = pdfDataUri;

  var file = new File(
    [pdfBytes],
    "Postpartum record.pdf",
    {
      type: "application/pdf;charset=utf-8",
    }
  );
 saveAs(file);
};

const generatePDF3 = async (name) => {
  const existingPdfBytes = await fetch("./cert3.pdf").then((res) =>
    res.arrayBuffer()
  );

  // Load a PDFDocument from the existing PDF bytes
  const pdfDoc = await PDFDocument.load(existingPdfBytes);
  pdfDoc.registerFontkit(fontkit);

  //get font
  const fontBytes = await fetch("./Sanchez-Regular.ttf").then((res) =>
    res.arrayBuffer()
  );

  // Embed our custom font in the document
  const SanChezFont = await pdfDoc.embedFont(fontBytes);

  // Get the first page of the document
  const pages = pdfDoc.getPages();
  const firstPage = pages[0];
  
  // Draw a string of text diagonally across the first page
  firstPage.drawText(name, {
    x: 178,
    y: 630,
    size: 12,
    font: SanChezFont,
    color: rgb(0, 0, 0),
 
  });

  // Serialize the PDFDocument to bytes (a Uint8Array)
  const pdfBytes = await pdfDoc.save();
  console.log("Done creating");

  // this was for creating uri and showing in iframe

  // const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
  // document.getElementById("pdf").src = pdfDataUri;

  var file = new File(
    [pdfBytes],
    "Prenatal reocrd.pdf",
    {
      type: "application/pdf;charset=utf-8",
    }
  );
 saveAs(file);
};

const generatePDF4 = async (name) => {
  const existingPdfBytes = await fetch("./cert4.pdf").then((res) =>
    res.arrayBuffer()
  );

  // Load a PDFDocument from the existing PDF bytes
  const pdfDoc = await PDFDocument.load(existingPdfBytes);
  pdfDoc.registerFontkit(fontkit);

  //get font
  const fontBytes = await fetch("./Sanchez-Regular.ttf").then((res) =>
    res.arrayBuffer()
  );

  // Embed our custom font in the document
  const SanChezFont = await pdfDoc.embedFont(fontBytes);

  // Get the first page of the document
  const pages = pdfDoc.getPages();
  const firstPage = pages[0];

  // Draw a string of text diagonally across the first page
  firstPage.drawText(name, {
    x: 90,
    y: 657,
    size: 12,
    font: SanChezFont,
    color: rgb(0, 0, 0),
  });

  // Serialize the PDFDocument to bytes (a Uint8Array)
  const pdfBytes = await pdfDoc.save();
  console.log("Done creating");

  // this was for creating uri and showing in iframe

  // const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
  // document.getElementById("pdf").src = pdfDataUri;

  var file = new File(
    [pdfBytes],
    "Health record.pdf",
    {
      type: "application/pdf;charset=utf-8",
    }
  );
 saveAs(file);
};

// init();

// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};









