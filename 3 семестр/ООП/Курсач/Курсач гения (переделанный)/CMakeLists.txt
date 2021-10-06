cmake_minimum_required(VERSION 3.15)
project(CourseworkOOP)

set(CMAKE_CXX_STANDARD 17)

set(SFML_INCLUDE_DIR "C:/SFML-2.5.1/include")
set(SFML_LIBRARY_DIR "C:/SFML-2.5.1/lib")
set(SFML_DIR "C:/SFML-2.5.1/lib/cmake/SFML")

link_directories(SFML_LIBRARY_DIR)
include_directories(SFML_INCLUDE_DIR)

find_package(SFML 2.5.1 COMPONENTS system window graphics network audio)

if(SFML_FOUND)
    message(STATUS "SFML_INCLUDE_DIR: ${SFML_INCLUDE_DIR}")
    message(STATUS "SFML_LIBRARIES: ${SFML_LIBRARY_DIR}")
    message(STATUS "SFML_VERSION: ${SFML_VERSION}")
endif()

add_executable(CourseworkOOP main.cpp Application.cpp Application.hpp Board.cpp Board.hpp FieldCell.cpp FieldCell.hpp GameWindow.cpp GameWindow.hpp InfoWindow.cpp InfoWindow.hpp MainWindow.cpp MainWindow.hpp Ship.cpp Ship.hpp WindowInterface.cpp WindowInterface.hpp Assets.cpp Assets.hpp GlobalVars.hpp)
target_link_libraries (CourseworkOOP sfml-graphics sfml-window sfml-audio sfml-system)