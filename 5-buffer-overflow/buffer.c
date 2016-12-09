#include<stdio.h>
#include<stdlib.h>
#include<string.h>

void inner_function(int);
void outer_function();
void unsafe_function();
char* argument;
char* buffer;
void inner_function(int i)
{
	printf("%d %p\n", i, unsafe_function);
	char local_buffer[8] = "bbbbbbb\0";
	char buf[8] = "aaaaaaa\0";
	//scanf("%s", buf);
	strcpy(buf, buffer);
	printf("Value of buf: %s\n", buf);
	printf("Value of local buffer: %s\n", local_buffer);
	argument = (char*)local_buffer;
}

void outer_function()
{
	int x = 117, i = 0;
	while (x > 1)
	{
		if (x % 2) x = x * 3 + 1;
		else x = x / 2;
		i++;
	}
	inner_function(i);
}
void unsafe_function()
{
	printf("+========+\n|        |\n| HACKED |\n|        |\n+========+\n\n");
	//Replace '\xff' with a null byte
	for (int i = 0; i < 256; i++)
	{
		//Handle two's complement :)
		if (argument[i] == -1 || argument[i] == 255)
		{
			argument[i] = 0;
			break;
		}
	}
	printf("------executing %s-----\n", argument);
	FILE* fp = fopen(argument, "r");
	printf("Got the password from the file\n");
	char c;
	while ((c = fgetc(fp)) != EOF)
		printf("%c", c);
	fclose(fp);
}
int main(int argc, char** argv)
{
	buffer = argv[1];
	outer_function();
	return 0;
}
