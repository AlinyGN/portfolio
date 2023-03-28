#!/usr/bin/env python3
# -*- coding: utf-8 -*-

from tkinter import *
from tkinter import filedialog

class Packing:
    def __init__( self, objeto_Tk ):
        objeto_Tk.title( "Montador de Vetores" )

        self.frNomeArqDados = Frame( objeto_Tk );
        self.frNomeArqDados.pack();
        Label( self.frNomeArqDados, text = "Arq. com os dados (EEG):",
               fg = 'darkblue', height = 3 ).pack( side = LEFT, padx=10 )
        self.entryNomeArqDados = Entry( self.frNomeArqDados, width = 80 )
        self.entryNomeArqDados.pack( side = LEFT )
        self.btNomeArqDados = Button( self.frNomeArqDados, text = 'Procurar',
                                      command = self.prssBtNomeArqDados )
        self.btNomeArqDados.pack( side = LEFT, padx=10 )
        
        self.frNomeArqEscrito = Frame( objeto_Tk );
        self.frNomeArqEscrito.pack();
        Label( self.frNomeArqEscrito, text = "Arq. de saída:",
               fg = 'darkblue', height = 3 ).pack( side = LEFT, padx=10 )
        self.entryNomeArqEscrito = Entry( self.frNomeArqEscrito, width = 80 )
        self.entryNomeArqEscrito.pack( side = LEFT, padx=10 )

        self.frParams = Frame( objeto_Tk )
        self.frParams.pack()
        Label( self.frParams, text = ' Parâmetros: ',
               fg = 'green', height = 3 ).pack( side = LEFT, padx=10 )

        Label( self.frParams, text = 'Tamanho das janelas: ',
               fg = 'darkblue', height = 3 ).pack( side = LEFT, padx=10, pady=10 )
        self.entryTamanhoJanelas = Entry( self.frParams, width = 3 )
        self.entryTamanhoJanelas.pack( side = LEFT, padx=10 )

        Label( self.frParams, text = ' Quantos vetores: ',
               fg = 'darkblue', height = 3 ).pack( side = LEFT, padx=10, pady=10 )
        self.entryQuantVetores = Entry( self.frParams, width = 3 )
        self.entryQuantVetores.pack( side = LEFT, padx=10)

        Label( self.frParams, text = ' Antecedência à crise (min): ',
               fg = 'darkblue', height = 3 ).pack( side = LEFT, padx=10, pady=10 )
        self.entryAntecedencia = Entry( self.frParams, width = 3 )
        self.entryAntecedencia.pack( side = LEFT, padx=10 )

        Label( self.frParams, text = ' Intervalo entre vetores (seg): ',
               fg = 'darkblue', height = 3 ).pack(side = LEFT, padx=10, pady=10 )
        self.entryIntervalo = Entry( self.frParams, width = 3 )
        self.entryIntervalo.pack( side = LEFT, padx=10 )

        self.frDados = Frame( objeto_Tk )
        self.frDados.pack()
        Label( self.frDados, text = ' Dados do arquivo: ',
               fg = 'green', height = 3 ).pack( side = LEFT, padx=10 )

        Label( self.frDados, text = ' Início da crise (seg): ',
               fg = 'darkblue', height = 3 ).pack( side = LEFT, padx=10 )
        self.entryInicioCrise = Entry( self.frDados, width = 8 )
        self.entryInicioCrise.pack( side = LEFT, padx=10 )

        self.frExecuta = Frame( objeto_Tk )
        self.frExecuta.pack()
        self.btExecuta = Button( self.frExecuta, text = 'Executar' )
        self.btExecuta['width']=10
        self.btExecuta.bind( "<Button-1>", self.prssBtExecuta )
        self.btExecuta.pack( side = LEFT, padx=10 )

        self.frBtSai = Frame( objeto_Tk )
        self.frBtSai.pack()
        self.btSai = Button( self.frBtSai, text = 'Sair', command = quit )
        self.btSai['width']=10
        self.btSai.pack( side = RIGHT, padx=10, pady=10 )

    def prssBtNomeArqDados( self ):
        self.strNomeArqDados = \
            filedialog.askopenfilename( filetypes = [ ( 'TXT', '*.TXT' ),
                                                      ( 'txt', '*.txt' ),
                                                      ( 'todos', '*' ) ] )
        self.entryNomeArqDados.delete( 0, END )
        self.entryNomeArqDados.insert( 0, self.strNomeArqDados )

    def prssBtExecuta( self, event ):
        tamJanela = int( self.entryTamanhoJanelas.get() )
        vetores = int( self.entryQuantVetores.get() )
        antecede = int( self.entryAntecedencia.get() )
        intervalo = int( self.entryIntervalo.get() )
        criseIni = int( self.entryInicioCrise.get() )
     #   criseFim = int( self.entryFimCrise.get() )

        arq = open( self.strNomeArqDados, 'r' )
        print( "Arquivo aberto" )
        #descarta a 1ª linha
        print(arq.readline())
        #lê linhas numéricas
        contaLinhas = 0
        arqEscrito = open( self.entryNomeArqEscrito.get(), 'w')
        vetor = []
        totLinhas = arq.readlines()
        crise = criseIni*256 # Esse número 2996 terá de ser ajustável. OK!
        antecedeCrise = antecede*256*60
        inicio = crise-antecedeCrise
        numColuna = 1
        numVetor = 0
        while numVetor < vetores:
                final = inicio+tamJanela
                posLinha = totLinhas[inicio:final]
                for linha in posLinha:
                        dividida = linha.split(' ')
                        x = float(dividida[numColuna])
                        vetor.append(x)
                        contaLinhas += 1
                        if contaLinhas > tamJanela:
                                vetor.pop(0)
                        if contaLinhas >= tamJanela:
                                s1 = str(vetor)
                                s2 = s1.replace('[', '')
                                s3 = s2.replace(']', '')
                                s4 = s3.replace(',', '')
                                print('linha ',inicio,'vetor ',numVetor,': ', s4)
                                arqEscrito.write(str(s4)+'\n')
                                numVetor += 1
                        if contaLinhas == tamJanela:
                                break
                        if tamJanela == 0:
                                break
                        if intervalo > 1:
                            pula = intervalo*256
                            inicio = inicio+pula
                        else:
                            inicio += 1
        arqEscrito.close()
        arq.close()
        print('Arquivo fechado')
raiz = Tk()
Packing( raiz )
raiz.mainloop()
