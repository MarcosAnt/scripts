/*
//                            > > Sistema Revenda < <
//
// Sistema básico simula revenda de automóveis.
// Utiliza conceito CRUD.
// CRUD: 
//      Creat (criar/escrever)
//      Read (ler)
 //     Update (modificar/atualizar)
 //     Delete (apagar).
*/
#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>//para tolower
#include <string.h>

FILE *arq_bd, *arq_ve;//COLOQUEI COMO GLOBAL PQ ELE FECHA NA CONSULTA E IA TER Q PASSAR ELE PRA TODO LUGAR :D
int i, j;
struct carro{
        char placa[10];
        char modelo[26];
        char valor[20];
    };
struct carro ca[100]; //COLOQUEI ASSIM PQ NAO TAVA SALVANDO NA STRUCT, SÓ APARECIA NA HORA DE CARREGAR
struct carro ve[100];


/*=======================FUNÇÕES PARA CARREGAR E GRAVR DADOS=======================*/


void carrega_dados()//MUDEI PRA VOID PQ ELE NAO RETORNA NADA :P
{
    arq_bd=fopen("db-sistema-revenda.txt", "r");//abre arquivo para leitura e escrita
    arq_ve=fopen("carros-vendidos.txt", "r");   //e guarda no pronterio arq_bd

    if((arq_bd == NULL)||(arq_ve == NULL)){//verifica se o ponteiro tem o endereço do arquivo
        printf("Erro ao abrir o arquivo.\n");
        exit(1);
    }

    for(i=0; (!feof(arq_bd)); i++)/*feof retorna 0 qnd não encontra o fim do arquivo por isso "!feof..." pq enquato não achar o fim
                                //vai retornar 0 mas vai ter o "!" e vai mudar pra 1 e executa o for
                                //qnd achar o fim do arquivo vai retornar 1 q vai ser negado, vai mudar pra 0, e sai do for*/
    {
        fgets(ca[i].placa, 10, arq_bd);//vai no arquivo e le a placa
        ca[i].placa[strlen(ca[i].placa)-1] = '\0';
        fgets(ca[i].modelo, 26, arq_bd);//vai no arquivo e le o modelo
        ca[i].modelo[strlen(ca[i].modelo)-1] = '\0';
        fgets(ca[i].valor, 20, arq_bd);//vai no arquivo e le o valor
        ca[i].valor[strlen(ca[i].valor)-1] = '\0';

    }

    for(j=0; (!feof(arq_ve)); j++)
    {
        fgets(ve[j].placa, 10, arq_ve);
        ve[j].placa[strlen(ve[j].placa)-1] = '\0';
        fgets(ve[j].modelo, 26, arq_ve);
        ve[j].modelo[strlen(ve[j].modelo)-1] = '\0';
        fgets(ve[j].valor, 20, arq_ve);
        ve[j].valor[strlen(ve[j].valor)-1] = '\0';
    }

    fclose(arq_bd);
    fclose(arq_ve);
    i--;
    j--;
    /*o for incrementa mais uma vez antes de sair, isso ia dar errado pra usar o i
    de indicie na outra função se for preciso inserir um novo carro*/

}



/*=======================só pra separar uma coisa da outra=======================*/


void nova_consulta()
{
    char opc;

    system("cls");
    printf("\tFazer nova consulta?\n\n[s]Sim\t[n]Nao\n");

    do{//valida a entrada
        scanf("%c", &opc);
        opc=tolower(opc);
    }while((opc!='s')&&(opc!='n'));

    if(opc=='s'){//se sim, chama a main para começar tudo de novo
        menu();}
    else{
        printf("\n\t\tEncerrando programa...\n");//se não, encerra o programa
        fclose(arq_bd);
        fclose(arq_ve);
        exit(0);
    }

}



void novo_carro()
{
char res, placa[9], modelo[26], preco[20];//CRIEI ESSAS VARIAVEIS DE USO TEMPORARIO, JA Q PRA IR PRA STRUCT ELE LE DIRETO DO ARQUIVO
int lower=0, cont;

    arq_bd=fopen("db-sistema-revenda.txt", "a+");//abre arquivo para leitura e escrita

    if(arq_bd == NULL){//verifica se o ponteiro tem o endereço do arquivo
        printf("Erro ao abrir o arquivo.\n");
        exit(1);
    }


    scanf("%*c");//só pra limpar buffer;

volt:
    printf("\nInforme a placa do carro:\n");
    fflush(stdin);
    gets(placa);//NAO TENHO CERTEZA PQ MUDEI AQUI, MAS ACHO Q ERA PQ N TAVA ESCREVENDO NO ARQUIVO
    placa[strlen(placa)-1]='\0';
      while(placa[lower]){
            placa[lower]=tolower(placa[lower]);
            lower++;}

        for(cont=0; cont<i; cont++)
            if(strncmp(ca[cont].placa, placa,strlen(placa))==0){
               printf("\n CARRO J%c CADASTRADO!\n", 181);
               printf("\nGostaria de cadastrar um outro carro? (s/n)\n");
               scanf("%c", &res);
               res=tolower(res);
                    if(res=='n')
                        nova_consulta();
                        else
                            if(res=='s')
                                goto volt;}

    fprintf(arq_bd,"%s\n", placa);

    fflush(stdin);//só pra limpar buffer;

    printf("Informe o modelo do carro:\n");
    gets(modelo);//AQUI TBM
    fprintf(arq_bd,"%s\n", modelo);

    printf("Informe o valor do carro:\n");
    gets(preco);
    fprintf(arq_bd,"%s\n", preco);

    system("pause");
    fclose(arq_bd);
    carrega_dados();
    i++;
    nova_consulta();
}





void listar_todos()
{
    int a;
    system("cls");
    printf("\n");//só pra pular linha msm
    if(i==0){
        printf("=================================================================\n");
        printf("\t\t   .:NENHUM REGISTRO DISPON%cVEL:.            \n", 214);
        printf("=================================================================\n");}
    else{
        printf("=============================================================\n");
        printf("\t\t   .:AUTOM%cVEIS DISPON%cVEIS:.            \n", 224,214);
        printf("=============================================================\n");
            for(a=0;a<i;a++)
            {
                printf("\t\t  CARRO %i:\n", a+1);
                printf("\t\t  Placa: %s\n", ca[a].placa);
                printf("\t\t  Modelo: %s\n", ca[a].modelo);
                printf("\t\t  Valor: %s\n\n", ca[a].valor);
            }
        }
    system("pause");
    nova_consulta();
}




void vender(int ind)
{

int aux;
    strcpy(ve[j].placa,ca[ind].placa);
    strcpy(ve[j].modelo,ca[ind].modelo);
    strcpy(ve[j].valor,ca[ind].valor);

    for(;ind<i;ind++)//vai sobrescrever o carro vendido
    {
        strcpy(ca[ind].placa,ca[ind+1].placa);
        strcpy(ca[ind].modelo,ca[ind+1].modelo);
        strcpy(ca[ind].valor,ca[ind+1].valor);
    }
i--;

fclose(arq_bd);
fclose(arq_ve);
    arq_bd=fopen("db-sistema-revenda.txt", "w");//abre arquivo para leitura e escrita
    arq_ve=fopen("carros-vendidos.txt", "a+");   //e guarda no pronterio arq_bd

    if((arq_bd == NULL)||(arq_ve == NULL)){//verifica se o ponteiro tem o endereço do arquivo
        printf("Erro ao abrir o arquivo.\n");
        exit(1);
    }
        for(aux=0;aux<i;aux++){
            fprintf(arq_bd, "%s\n", ca[aux].placa);
            fprintf(arq_bd, "%s\n", ca[aux].modelo);
            fprintf(arq_bd, "%s\n", ca[aux].valor);}

    fprintf(arq_ve, "%s\n", ve[j].placa);
    fprintf(arq_ve, "%s\n", ve[j].modelo);
    fprintf(arq_ve, "%s\n", ve[j].valor);
j++;
fclose(arq_bd);
fclose(arq_ve);
carrega_dados();
}


//recebe em opc o parâmetro para saber se pesquisa por placa ou por modelo
void pesquisar_carro(char opc)
{
char mod_carro[26], placa_carro[9];
int cont, k=0, l=0, lower=0;

    switch (opc){
    case 'm':

        printf("\nInforme o modelo que deseja:\n");
        scanf("%s", mod_carro);
        while(mod_carro[lower]){
            mod_carro[lower]=tolower(mod_carro[lower]);
            lower++;
        }
        mod_carro[strlen(mod_carro)-1] = '\0';
        for(cont=0; cont<i; cont++)
            /*o strcmp retorna 0 qnd as strings são iguais por isso a comparação*/
            if(strncmp(ca[cont].modelo, mod_carro, strlen(mod_carro))==0){
                l++;
                if(l==1)
                    printf("\n\t\tCARROS PARA VENDA:\n");
                printf("\tPalaca: %s\n", ca[cont].placa);
                printf("\tModelo: %s\n", ca[cont].modelo);
                printf("\tValor: %s\n\n", ca[cont].valor);}

                for(cont=0; cont<i; cont++)
                    if(strncmp(ve[cont].modelo, mod_carro, strlen(mod_carro))==0){
                    k++;
                    if(k==1)
                        printf("\n\t\tCARROS VENDIDOS:");
                    printf("\n\tCARRO: %i\n", k);
                    printf("\tPlaca: %s\n", ve[cont].placa);
                    printf("\tModelo: %s\n", ve[cont].modelo);
                    printf("\tValor: %s\n\n", ve[cont].valor);}


       if((l==0)&&(k==0))
       printf("\n\nNenhum registro encontrado.\n\n");
         system("pause");
         nova_consulta();
    break;

    case 'p':

        printf("\nInforme a placa que deseja:\n");
        scanf("%s", placa_carro);
        while(placa_carro[lower]){
            placa_carro[lower]=tolower(placa_carro[lower]);
            lower++;
        }
        printf("%s\n", placa_carro);
        system("pause");
        placa_carro[strlen(placa_carro)-1]='\0';
        for(cont=0; cont<i; cont++){
            if(strncmp(ca[cont].placa, placa_carro,strlen(placa_carro))==0){
                k++;
                printf("\n\tCarro %i:\n", k);
                printf("\tPlaca: %s\n", ca[cont].placa);
                printf("\tModelo: %s\n", ca[cont].modelo);
                printf("\tValor: %s\n\n", ca[cont].valor);

                printf("Gostaria de vender este carro?\n[s]Sim\t[n]Nao\n");
                scanf("%*c%c", &opc);

                if(opc=='s'){
                    vender(cont);//passa o indice onde achou o carro q quer vender
                    printf("\t\t.: VENDA REGISTRADA COM SUCESSO :.\n\n");
                    carrega_dados();
                    break;}
            }
        }

    if(k==0){
        printf("\n\nNenhum registro encontrado.\n\n");
    }
    system("pause");
    nova_consulta();
    break;
}
}


//talvez seja bom usar uma variável gobla para guardar quanto foi vendido para montar o relatorio
//ou guadar isso por último no arquivo
void relatorio()
{
    float tot_vendas=0;
    int b;
    system("cls");
    printf("==========================================\n");
    printf("\t  .:VENDAS EFETUADAS:.                \n");
    printf("==========================================\n");
    printf("\n");//só pra pular linha msm
    for(b=0;b<j;b++)
    {
        printf("\tCARRO %i:\n", b+1);
        printf("\tPlaca: %s\n", ve[b].placa);
        printf("\tModelo: %s\n", ve[b].modelo);
        printf("\tValor: %s\n\n", ve[b].valor);
        tot_vendas+=(atof(ve[b].valor));
    }
    printf("==========================================\n");
    printf("\t\tTotal vendido:\n\t\tR$ %.2f\n", tot_vendas);
    printf("==========================================\n");
    system("pause");
    nova_consulta();
}



//direciona o programa para as determinadas funções
int menu(){
char opcao;//para saber se pesquisa por placa ou modelo

    int  opc;//para menu

    system("cls");
    printf("=====================================================\n");
    printf("==========                                 ==========\n");
    printf("=======  .: SISTEMA REVENDA DE AUTOM%cVEIS :.  =======\n", 224);
    printf("==========                                 ==========\n");
    printf("=====================================================\n");
    printf(">Escolha uma operacao:\n\n");
    printf("\t[1] Novo Carro\n");
    printf("\t[2] Listar Todos\n");
    printf("\t[3] Pesquisar Carro\n");
    printf("\t[4] Relatorio\n");
    printf("\t[5] Sair\n");

    scanf("%i", &opc);

    switch(opc){
        case 1:
            novo_carro();
            break;
        case 2:
            listar_todos();
            break;
        case 3:
            printf("\n\nPesquisar por:\n[p] Placa\n[m] Modelo\n");
            do{//valida entrada
                scanf("%*c%c", &opcao);
                opcao=tolower(opcao);
            }while((opcao!='m')&&(opcao!='p'));
            pesquisar_carro(opcao);
            break;
        case 4:
            relatorio();
            break;
        case 5:
            printf("\n\t\tEncerrando programa...\n");
            //aqui vai ir uma função para gravar os dados no arquivo antes de sair
            exit(0);
            break;
        default:
            printf("\n\t\tOps... Opcao invalida.\n\t\tTente Novamente.\n\n");
            system("pause");
            main();
            break;
    }
}



int main()
{

    carrega_dados();/*chama para carregar dados do arquivo para o programa no vetor de struct*/

    menu();//dentro do menu direcionar para as outras funções

}
