#include <direct.h>
#include <stdio.h>
#include <stdlib.h>
#include <conio.h>
#include <Windows.h>

void moveCursor(int col, int row) {
    printf("\033[%d;%dH", row, col);
}
void setTextColor(int color) {
    HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
    SetConsoleTextAttribute(hConsole, color);
}

int main(){

    FILE *file = fopen("html.html", "w");
    fprintf(file, "<!DOCTYPE html>\n<html lang='en'>\n<head>\n<meta charset='UTF-8'>\n<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n<title>Document</title>\n</head>\n<body>\n");
    fclose(file);

    
    int ch;
    while(ch!=13){
        FILE *html = fopen("html.html", "a");
        char text[512];
        system("cls");
        
        setTextColor(4); printf("PRIDAT:\n\n");
        setTextColor(8); printf("[1]: nadpis\n[2]: clanek\n[3]: obrazek\n[4]: odkaz");
    
        ch = getch();
        system("cls");
        setTextColor(4);

        switch(ch-48){
            case 1:
                printf("vas nadpis:\n");
                setTextColor(10); fgets(text, sizeof(text), stdin);
                
                fprintf(html, "<h1>%s</h1>", text);
                break;
            case 2:
                printf("obsah clanku:\n"); 
                setTextColor(10); fgets(text, sizeof(text), stdin);

                fprintf(html, "<div>%s</div>", text);
                break;
            case 3:
                printf("vlozte URL obrazku nebo assets/nazevObrazku:\n");
                setTextColor(10); fgets(text, sizeof(text), stdin);

                fprintf(html, "<img src='%s'>", text);
                break;
            case 4:
                printf("vlozte URL:\n");
                setTextColor(10); fgets(text, sizeof(text), stdin);
                setTextColor(4); printf("\n\nvlozte nazev k odkazu:\n");
                char nazev[64];
                setTextColor(10); fgets(nazev, sizeof(nazev), stdin);
                
                fprintf(html, "<a href='%s'>%s</a>", text, nazev);
                break;
        }
        fclose(html);
    }
    return 0;
}