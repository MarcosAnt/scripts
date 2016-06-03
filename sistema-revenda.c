#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>//para tolower
#include <string.h>

FILE *arq_bd;//COLOQUEI COMO GLOBAL PQ ELE FECHA NA CONSULTA E IA TER Q PASSAR ELE PRA TODO LUGAR :D
int i;
struct carro{
        char placa[15];
        char modelo[26];
        float valor;
    };
struct carro ca[100]; //COLOQUEI ASSIM PQ NAO TAVA SALVANDO NA STRUCT, SÓ APARECIA NA HORA DE CARREGAR

/*=======================só pra separar uma coisa da outra=======================*/


void carrega_dados()//MUDEI PRA VOID PQ ELE NAO RETORNA NADA :P
{
    for(i=0; (!feof(arq_bd)); i++)/*feof retorna 0 qnd não encontra o fim do arquivo por isso "!feof..." pq enquato não achar o fim
                                //vai retornar 0 mas vai ter o "!" e vai mudar pra 1 e executa o for
                                //qnd achar o fim do arquivo vai retornar 1 q vai ser negado, vai mudar pra 0, e sai do for*/
    {
        fscanf(arq_bd, "%s", ca[i].placa);//vai no arquivo e le a placa
        fscanf(arq_bd, "%s", ca[i].modelo);//vai no arquivo e le o modelo
        fscanf(arq_bd, "%f", &ca[i].valor);//vai no arquivo e le o valor
    }
    i--;
    /*o for incrementa mais uma vez antes de sair, isso ia dar errado pra usar o i
    de indicie na outra função se for preciso inserir um novo carro*/
}



void nova_consulta()
{
    char opc;

    system("cls");
    printf("\tFazer nova consulta?\n\n[s]Sim\t[n]Nao\n");

    do{//valida a entrada

    scanf("%*c%c", &opc);
    opc=tolower(opc);

    }while((opc!='s')&&(opc!='n'));

    if(opc=='s'){//se sim, chama a main para começar tudo de novo
            fclose(arq_bd);//COLOQUEI O TRECO DE FECHAR AQUI, PQ ANTES ELE NEM CHEGAVA NA LINHA DE FECHAR E NAO SALVAVA NOVAS INFORMAÇÕES
        main();
    }else{
        printf("\n\t\tEncerrando programa...\n");//se não, encerra o programa
        //aqui vai ir uma função para gravar os dados no arquivo antes de sair
        exit(0);
    }

}



void novo_carro()
{
    float preco;
    char letra, placa[9], modelo[26];//CRIEI ESSAS VARIAVEIS DE USO TEMPORARIO, JA Q PRA IR PRA STRUCT ELE LE DIRETO DO ARQUIVO

    printf("i=%i\n", i);

    scanf("%*c");//só pra limpar buffer;

    printf("\nInforme a placa do carro:\n");
    gets(placa);//NAO TENHO CERTEZA PQ MUDEI AQUI, MAS ACHO Q ERA PQ N TAVA ESCREVENDO NO ARQUIVO
    fprintf(arq_bd,"%s\n", placa);

    fflush(stdin);//só pra limpar buffer;

    printf("Informe o modelo do carro:\n");
    gets(modelo);//AQUI TBM
    fprintf(arq_bd,"%s\n", modelo);

    printf("Informe o valor do carro:\n");
    scanf("%f", &preco);
    fprintf(arq_bd,"%.3f\n", preco);

    system("pause");

    nova_consulta();
}




void listar_todos()
{
    int a;

    printf("\n");//só pra pular linha msm
    for(a=0;a<i;a++)
    {
        printf("CARRO %i:\n", a+1);
        printf("Placa: %s\n", ca[a].placa);
        printf("Modelo: %s\n", ca[a].modelo);
        printf("Valor: %.3f\n\n", ca[a].valor);}
    system("pause");
    nova_consulta();
}




//recebe em opc o parâmetro para saber se pesquisa por placa ou por modelo
void pesquisar_carro(char opc)
{
    char mod_carro[26], placa_carro[9];
    int cont, erro=0;

    if(opc=='m'){
        printf("\nInforme o modelo que deseja:\n");
        scanf("%s", mod_carro);

        for(cont=0; cont<i; cont++)
        {   /*o strcmp retorna 0 qnd as strings são iguais por isso a comparação*/
            if(strcmp(ca[cont].modelo, mod_carro)==0){
                printf("\n%s\n", ca[cont].placa);
                printf("%s\n", ca[cont].modelo);
                printf("%.3f\n\n", ca[cont].valor);
            }else{
                erro=1;//se não achar nada muda aqui
            }
        }
    }else{
        printf("\nInforme a placa que deseja:\n");
        scanf("%s", placa_carro);

        for(cont=0; cont<i; cont++)
        {   /*o strcmp retorna 0 qnd as strings são iguais por isso a comparação*/
            if(strcmp(ca[cont].placa, placa_carro)==0){
                printf("\n%s\n", ca[cont].placa);
                printf("%s\n", ca[cont].modelo);
                printf("%.3f\n\n", ca[cont].valor);
            }else{
                erro=1;
            }
        }
    }
    if(erro){
        printf("\n\nNenhum registro encontrado.\n\n");
    }
    system("pause");
    nova_consulta();
}


//talvez seja bom usar uma variável gobla para guardar quanto foi vendido para montar o relatorio
//ou guadar isso por último no arquivo
void relatorio()
{

    nova_consulta();
}



//direciona o programa para as determinadas funções
void menu()
{
    char opcao;//para saber se pesquisa por placa ou modelo

    int  opc;//para menu

    //system("cls");

    printf("===================================================\n");
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
    int aux=0;

    arq_bd=fopen("db-sistema-revenda.txt", "a+");//abre arquivo para leitura e escrita
                                         //e guarda no pronterio arq_bd

    if(arq_bd == NULL){//verifica se o ponteiro tem o endereço do arquivo
        printf("Erro ao abrir o arquivo.\n");
        exit(1);
    }

    carrega_dados();/*chama para carregar dados do arquivo para o programa
                            //recebe em "i" o indicie onde parou o vetor de struct*/

    menu();//dentro do menu direcionar para as outras funções

}
