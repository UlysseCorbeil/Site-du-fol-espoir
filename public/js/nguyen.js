var vers = document.getElementsByClassName("vers");

for (var i = 0; i < vers.length; i++) {
    var x = vers[i].innerText;
    var each_word = x.split(" ");
    var new_strike = " ";
    var longest_word = findLongestWord(x);
    for (var y = 0; y < each_word.length; y++) {
        if (each_word[y] == longest_word) {

            if (each_word[y] == each_word[each_word.length - 1]) {
                new_strike = new_strike + each_word[y].replace(each_word[y], ('<span class="highlight"> ' + each_word[y] + '</span>'));
            } else {
                new_strike = new_strike + each_word[y].replace(each_word[y], ('<span class="highlight"> ' + each_word[y] + '</span>'));
            }

        } else if (each_word[y - 1] == longest_word) {
            new_strike = new_strike + each_word[y].replace(each_word[y], (' <span class="strike">' + each_word[y] + '</span>'));
        } else {
            new_strike = new_strike + each_word[y].replace(each_word[y], ('<span class="strike"> ' + each_word[y] + '</span>'));
        }
    }
    vers[i].innerHTML = new_strike;
}

function findLongestWord(str) {
    const stringArray = str.split(" ");
    const longestWord = stringArray.reduce((a, b) => {
        if (b.length > a.length) {
            return b;
        } else {
            return a;
        }
    });
    return longestWord;
}


