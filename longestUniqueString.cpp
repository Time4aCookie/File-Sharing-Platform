// Created by Rohan Tatikonda on 5/18/23.
#include "longestUniqueString.h"

using namespace std;

int longestUniqueString::LongestUniqueString(string s){
	vector<string> letters;
	int counter = 0;
	int position = 0;
	int maxCounter;


	while(position < s.length()) {
		string currentLetter = s.substr(position,1);
		while (find(letters.begin(), letters.end(), currentLetter) == letters.end()) {
			letters.push_back(currentLetter);
			counter++;
			position++;
			currentLetter = s.substr(position,1);
			if(position >= s.length()){
				break;
			}
		}
		if (counter > maxCounter) {
			maxCounter = counter;
		}

		position = position - counter +1;
		counter = 0;
		letters.erase(letters.begin(), letters.end());
	}
	return maxCounter;
}


