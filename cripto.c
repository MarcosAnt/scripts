/*
//       >> CRIPTOGRAFIA SIMPLES EM C ANSI <<
// Troca uma letra pela que está duas vezes na sua frente.
//
// EX.: B -> posição 2 -> substituir por D.
*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	char alfabeto[]={"ABCDEFGHIJKLMNOPQRSTUVWXYZ"};
	char msg[80];
	int i, j, space;

	while(1)
	{
		printf("INFORME A MENSAGEM:\t\t\t\tPARA SAIR DIGITE 0\n");
		fgets(msg, 80, stdin);

		if(msg[0]=='0'){
			break;//sair
		}
		//tira o \0 do fim da string e manda para o fim da frase lida
		msg[strlen(msg)-1]='\0';
		//deixa tudo mauisculo
		for(i=0; msg[i]!='\0'; i++)
		{
			msg[i]=toupper(msg[i]);
		}

		space=i=0;
		//retirar espaços
		do{
			if(msg[i]==' '){
				space++;
				for(j=i; (j+1)<(strlen(msg)); j++)
				{
					msg[j]=msg[j+1];
				}
			}
			i++;
		}while(i<strlen(msg));

		//reposiciona o \0 dps de tirar os espços
		msg[(i)-space]='\0';

		//vai executar oq tem no for até achar o \0
		for(i=0; msg[i]!='\0'; i++)
		{
			for(j=0; j<27; j++)
			{
				//qnd achar a letra para e sai
				if(msg[i]==alfabeto[j]){
					break;
				}
			}

			/*qnd sair do segudo for, o j vai estar na posição da letra q quer substituir,
			//por isso soma 1 e soma ele com ele msm pq é a chave usada*/
			j=j+(j+1);
			//se estiver além do Z, vai receber Z
			if(j>25){
				msg[i]='Z';
			}else{
				msg[i]=alfabeto[j];
			}
		}

		printf("\nCriptografado= %s\n\n", msg);
	}

	return 0;
}
