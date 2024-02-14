#include <stdio.h>
void main()
{
    int a=1,b=3;
    a+=b-=a-=b;
    printf("%d%d",a,b);
}