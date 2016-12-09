#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc,const char *argv[]) {
	FILE* fp = fopen("passwords.txt", "w");
	char* characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	int character_length = strlen(characters);
	char new_line = '\n';
	
	int num_passwords = 10000;
	for(int i = 0; i < num_passwords; i++) {
		int length = rand() % 17 + 4;
		char* password = malloc(sizeof(*password) * length);
		for(int j = 0; j < length; j++) {
			char curr = characters[rand() % character_length];
			password[j] = curr;
		}
		
		int number_length = 0;
		int curr_num = i + 1;
		while (curr_num > 0) {
				number_length++;
				curr_num /= 10;
		}
		
		char* i_string = malloc(number_length);
		curr_num = i + 1;
		for(int j = number_length - 1; j >= 0; j--) {
			i_string[j] = curr_num % 10 +48;
			curr_num /= 10;
		}
		
		int digits = 0;
		curr_num = length;
		while (curr_num > 0) {
			digits++;
			curr_num /= 10;
		}
		
		char* length_string = malloc(digits);
		curr_num = length;
		for(int j = digits - 1; j >= 0; j--) {
			length_string[j] = curr_num % 10 + 48;
			curr_num /= 10;
		}

		fwrite(i_string, number_length, 1, fp);
		fwrite(&new_line, 1, 1, fp);

		fwrite(length_string, digits, 1, fp);
		fwrite(&new_line, 1, 1, fp);

		fwrite(password, length, 1, fp);
		fwrite(&new_line, 1, 1, fp);
		
		fwrite(&new_line, 1, 1, fp);
		
		free(i_string);
		free(length_string);
		free(password);
	}
	
	fclose(fp);
	
	return EXIT_SUCCESS;
}
