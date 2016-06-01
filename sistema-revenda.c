#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>//para tolower


struct atributos_carro{
        char placa[9];
        char modelo[26];
        float valor;
    }carro[100];


/*=======================só pra separar uma coisa da outra=======================*/


int carrega_dados(FILE *file)
{
    int i;
    float valor_carro;

    for(i=0; (!feof(file)); i++)/*feof retorna 0 qnd não encontra o fim do arquivo por isso "!feof..." pq enquato não achar o fim
                                //vai retornar 0 mas vai ter o "!" e vai mudar pra 1 e executa o for
                                //qnd achar o fim do arquivo vai retornar 1 q vai ser negado, vai mudar pra 0, e sai do for*/
    {
        fscanf(file, "%s", carro[i].placa);//vai no arquivo e le a placa
        printf("%s\n", carro[i].placa);
        fscanf(file, "%s", carro[i].modelo);//vai no arquivo e le o modelo
        printf("%s\n", carro[i].modelo);
        fscanf(file, "%f", &carro[i].valor);//vai no arquivo e le o valor
        printf("%f\n", carro[i].valor);
    }

    system("pause");
    /*retorna "i" para saber onde parou de caregar para se for preciso inserir um novo carro
    //o for incrementa mais uma vez antes de sair, isso ia dar errado pra usar o i de indicie na outra função*/
    return (i-1);
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
        main();
    }else{
        printf("\n\t\tEncerrando programa...\n");//se não, encerra o programa
        //aqui vai ir uma função para gravar os dados no arquivo antes de sair
        exit(0);
    }

}



void novo_carro(FILE *file, int i)
{
    int cont=0;
    char letra;

    /* esse "i" vem sendo passado de função pq contém o indice do vetor de struct para inserir o novo carro*/

    printf("i=%i\n", i);

    scanf("%*c");//só pra limpar buffer;

    printf("\nInforme a placa do carro:\n");
    fgets(carro[i].placa, 9, stdin);
    printf("%s\n", carro[i].placa);

    fflush(stdin);//só pra limpar buffer;

    printf("Informe o modedo do carro:\n");
    fgets(carro[i].modelo, 26, stdin);
    printf("%s\n", carro[i].modelo);

    printf("Informe o valor do carro:\n");
    scanf("%f", &carro[i].valor);
    printf("%.3f\n", carro[i].valor);

    //aqui vai ficar a chamada da fuura função para gravar dados no arquivo
    
    system("pause");

    nova_consulta();
}




void listar_todos()
{

    nova_consulta();
}




//recebe em opc o parâmetro para saber se pesquisa por placa ou por modelo
void pesquisar_carro(char opc)
{

    nova_consulta();
}


//talvez seja bom usar uma variável gobla para guardar quanto foi vendido para montar o relatorio
//ou guadar isso por último no arquivo
void relatorio()
{

    nova_consulta();
}



//direciona o programa para as determinadas funções
int menu(FILE *file, int i)
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
            novo_carro(file, i);
            break;
        case 2:
            listar_todos();
            break;
        case 3:
            printf("\n\nPesquisar por:\n[p] Placa\n[m] Modelo\n");
            scanf("%*c%c", &opcao);
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
    FILE *arq_bd;
    int i, aux=0;

    arq_bd=fopen("db-sistema-revenda.txt", "r+");//abre arquivo para leitura e escrita
                                         //e guarda no pronterio arq_bd

    if(arq_bd == NULL){//verifica se o ponteiro tem o endereço do arquivo
        printf("Erro ao abrir o arquivo.\n");
        exit(1);
    }

    i=carrega_dados(arq_bd);/*chama para carregar dados do arquivo para o programa
                            //recebe em "i" o indicie onde parou o vetor de struct*/

    menu(arq_bd, i);//dentro do menu direcionar para as outras funções


    fclose(arq_bd);
}
