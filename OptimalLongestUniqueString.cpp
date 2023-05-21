// Created by Rohan Tatikonda on 5/21/23.

#pragma once
#include "longestUniqueString.h"
#include <map>

using namespace std;

int longestUniqueString::LongestUniqueString(std::string s) {
	int left = 0;
	int right = 0;
	int max = 0;
	map<char, int> letters;
	for(int i = 0; i < s.length(); i++){
		char k = s[i];
		letters[k]++;
		while(letters[k] > 1){
			letters[s[left]]--;
			left++;
		}
		int l = right-left+1;
		if(l > max){
			max = l;
		}

	}
	return max;
}
int longestUniqueString::max(int& x, int& y) {
		if (x > y){
			return x;
		}
		return y;
	}
