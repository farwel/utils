/**
 * Extends arrays functionallity.
 */

/**
 * Remove duplicates in array.
 */
Array.prototype.unique = function() {
	if (!this.length) return this;
	var a = [], i;
	this.sort();
	for (i=0 ; i < this.length ; i++){
		if (this[i] !== this[i+1]) {
			a[a.length] = this[i];
		}
	}
	return a;
};

/**
 * Checks if an element is in the array.
 */
Array.prototype.contains = function(value) {
	return this.indexOf(value) > -1;
};

/**
 * Adds indexOf support to Arrays if not exits.
 */
if (typeof Array.prototype.indexOf == 'undefined'){
	Array.prototype.indexOf = function(elt){
		var len = this.length;

		var from = 0;
		from = (from < 0) ? Math.ceil(from)	: Math.floor(from);

		for (; from < len; from++){
			if (from in this && this[from] === elt)
				return from;
		}
		return -1;
	};
}

/**
* Shuffles the Array elements randomly.
*/
Array.prototype.shuffle = function(){
	var myArray = this, j, tempi,
		i = this.length;
	while ( --i ) {
		j = Math.floor( Math.random() * ( i + 1 ) );
		tempi = myArray[i];
		myArray[i] = myArray[j];
		myArray[j] = tempi;
	}
	return this;
}