/*
//                          > > Cifra de César em C ANSI - simples < <
//
// É um tipo de cifra de substituição na qual cada letra do texto é substituída por outra, que se apresenta 
// no alfabeto abaixo dela um número fixo de vezes. 
// Por exemplo, com uma troca de três posições, A seria substituído por D, B se tornaria E, e assim por diante.
// O nome do método é em homenagem a Júlio César, que o usou para se comunicar com os seus generais.
*/
#include <stdio.h>
#include <stdlib.h>

int main()
{
    int chave, i, g, aux;
    char palavra[500], alfa[]="abcdefghijklmnopqrstuvwxyz";

    printf("\t\t\tBem Vindo a Cifra de Cesar\n");
    while(1){
        printf("\n  Informe a mensagem para criptografar: [ate 500 carac]\n\n  Para sair digite 0 [zero]...\n\n");

        printf("\t> ");//apenas para dar espaço
        fgets(palavra, 499, stdin);

        palavra[strlen(palavra)-1]='\0';

        if(palavra[0]=='0')
            break;

        printf("\n  Informe a chave da criptografia:\n\n");

        printf("\t> ");//apenas para dar espaço
        scanf("%i", &chave);

        for(i=0; palavra[i]!='\0'; i++){
            g=0;
            while(1)
            {
                if(palavra[i]==alfa[g]){
                    break;
                }else{
                    g++;
                }    
            }
            
            //se estiver além dos limites do vetor, ou seja, além do 'z'
            if((g+chave)>25){
                //posição de 'z' - posição da letra
                g=25-g;
                //qntas letras pular dps do 'z'
                g=g-chave;
                //garantir q seja positivo
                if(g<0){
                    g=g*(0-1);
                }
                //tem q fazer -1 por causa do vetor começar em 0
                palavra[i]=alfa[g-1];
            }else{
                //se não estiver além dos limites do vetor
                palavra[i]=(alfa[g+chave]);
            }
        
        }

        printf("\n  Criptografada:\n\n");        
        printf("\n\t-> %s <-\n\n", palavra);
    
        fflush(stdin);
    }

    return 0;
}
