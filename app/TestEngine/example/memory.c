#include <stdio.h>
#include <stdlib.h>

#define MAX 5000000

int mem[MAX];

int main() {
	int a, b, i,j;
	scanf("%d %d", &a, &b);
	for (i = 0; i < MAX; ++i) {
		mem[i] = i;
	}
	for (i = 1; i < MAX; ++i) {
		mem[i] = mem[i-1];
	}
	printf("%d\n", mem[MAX-1]);
	return 0;
}
