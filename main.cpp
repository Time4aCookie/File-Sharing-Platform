// Created by Rohan Tatikonda on 5/18/23.
#include "longestUniqueString.h"
#include <iostream>
using namespace std;

int main(int argc, char * argv[]){
	if(argc == 2) {
		longestUniqueString test;
		int k = test.LongestUniqueString(argv[1]);
		cout << k << endl;
	}
}
