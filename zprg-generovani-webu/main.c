#include <direct.h>
#include <stdio.h>
#include <stdlib.h>

int main(){

    FILE *html = fopen("index.html", "w");
    fprintf(html, "<!DOCTYPE html><html>\
<head><title>Generovana stranka</title>\
            <style type = 'text/css'>\
            html { display: flex; box-sizing: border-box; justify-content: space-around;}\
            header, aside, section, footer { margin: .6em; padding: .5em; border: 1px solid black; border-radius: .4em; }\
            aside {font-style: italic; }\
            section { min-height: 70vh; min-width: 80vw;}\
            article { padding: .3em; }\
            </style></head>\
<body><header>");

    return 0;
}