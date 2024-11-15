
const mobileQuery = window.matchMedia("(max-width: 768px)");


function handleMobileView(e) {
  if (e.matches) {
    console.log("Mobile view active");
   
  } else {
    console.log("Desktop view active");
  
  }
}


mobileQuery.addListener(handleMobileView);


handleMobileView(mobileQuery);
