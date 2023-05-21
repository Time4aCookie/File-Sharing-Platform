cmake_minimum_required(VERSION 3.24)
project(LongestUniqueString)

set(CMAKE_CXX_STANDARD 14)

include_directories(.)

add_executable(LongestUniqueString
        longestUniqueString.cpp
        longestUniqueString.h
        main.cpp longestUniqueString.cpp OptimalLongestUniqueString.cpp)
