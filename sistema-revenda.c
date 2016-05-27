#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>//para tolower


struct atributos_carro{
        char placa[8];
        char modelo[25];
        float valor;
    }carro[100];


/*=======================só pra separar uma coisa da outra=======================*/


void carrega_dados(FILE *file)
{
    int i;
    float valor_carro;

    for(i=0; (feof(file)); i++)
    {
        fgets(carro[i].placa, 8, file);//vai no arquivo e le a placa
        fgets(carro[i].modelo, 25, file);//vai no arquivo e le o modelo
        fscanf(file, "%f", &carro[i].valor);//vai no arquivo e le o valor
    }

}


void nova_consulta()
{
    char opc;

    printf("\tFazer nova consulta?\n[s] Sim\t[n]Nao\n");

    do{//valida a entrada

    scanf("%c", &opc);
    opc=tolower(opc);

    }while((opc!='s')||(opc!='n'));

    if(opc=='s'){//se sim, chama a main para começar tudo de novo
        main();
    }else{
        printf("Encerrando programa...\n");//se não, encerra o programa
        //aqui vai ir uma função para gravar os dados no arquivo antes de sair
        exit(0);
    }

}



void novo_carro()
{

}


void listar_todos()
{

}


//recebe em opc o parâmetro para saber se pesquisa por placa ou por modelo
void pesquisar_carro(char opc)
{

}


//talvez seja bom usar uma variável gobla para guardar quanto foi vendido para montar o relatorio
//ou guadar isso por último no arquivo
void relatorio()
{

}

//direciona o programa para as determinadas funções
void menu()
{
    char opcao;//para saber se pesquisa por placa ou modelo

    int  opc;//para menu

    printf("===================================================");
    printf("Escolha uma operacao:\n\n");
    printf("\t[1] Novo Carro\n");
    printf("\t[2] Listar Todos\n");
    printf("\t[3] Pesquisar Carro\n");
    printf("\t[4] Relatório\n");
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
            printf("\n\nPesquisar por:\n[p] Placa;\n[m] Modelo\n");
            scanf("%c", &opcao);
            pesquisar_carro(opcao);
            break;
        case 4:
            relatorio();
            break;
        case 5:
            printf("Encerrando programa...\n");
            //aqui vai ir uma função para gravar os dados no arquivo antes de sair
            exit(0);
            break;
        default:
            printf("Ops... Opcao invalida.\nTente Novamente.\n");
            main();
            break;
    }
}



int main()
{
    FILE *arq_bd;

    //char end[]="db-sistema-revenda.txt";

    printf("ate aqui tudo bem senhor\n");

    arq_bd=fopen("db-sistema-revenda.txt", "a+");//abre arquivo para leitura e escrita
                                                 //e guarda no pronterio arq_bd

    if(arq_bd == NULL);{
        printf("Erro ao abrir o arquivo.\n");
        exit(1);
    }

    carrega_dados(arq_bd);//chama para carregar dados do arquivo para o programa

    menu();//dentro do menu direcionar para as outras funções

}
