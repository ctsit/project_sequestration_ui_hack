$( document ).ready(function() {

  // while loops are the most efficient way to iterate over arrays in javascript
  // https://stackoverflow.com/a/7252102/7418735
  let i = 0, l = PSUIH.pids.length;
  while (i < l) {
    let pid = PSUIH.pids[i];
    markSequestered($(`a.aGrid[href$='pid=${pid}']`));
    i++;
  }

});

function markSequestered(element) {
  $(element)
    .find("span")
    .html("Sequestered");
}
