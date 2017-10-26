#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[]) {
	FILE *solution = fopen(argv[1], "r");
	FILE *correct = fopen(argv[2], "r");
	int status = 0, r1, r2;
	char s1[101], s2[101];

	do {
		r1 = fscanf(solution, "%100s", s1);
		r2 = fscanf(correct, "%100s", s2);
		if (r1 != r2 || strcmp(s1, s2)) {
			status = 1;
			break;
		}
	} while (r1 > 0 && r2 > 0);

	fclose(solution);
	fclose(correct);

	return status;
}
