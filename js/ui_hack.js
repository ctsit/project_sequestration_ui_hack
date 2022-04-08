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
  let replacement_text = (PSUIH.replacement_text) ?? "Sequestered";
  // HACK: strip surrounding tags to avoid linebreak in badge while retaining styling
  // Drops any text after the first line in the config
  if (replacement_text != "Sequestered") {
    replacement_text = $(replacement_text).html()
  }
  $(element)
    .find("span")
    .html(replacement_text);
}
