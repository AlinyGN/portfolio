<h2>Aplicação de Máquina de Vetores de Suporte em modo Regressão à previsão de surtos epilépticos</h2>
<p>Artigo científico publicado na revista Tekhne e Logos da FATEC</p>
<p>Desenvolvimento de código em python para implementação de interface seletora na geração de vetores a partir de dados 
  obtidos de sinais de eletroencefalograma.</p>
__RESUMO__
<p>A previsão de surtos epilépticos vem sendo amplamente estudada na engenharia com a intenção
de prover maior qualidade de vida aos milhões de pacientes detentores desse distúrbio cerebral.
O avanço das técnicas de aprendizagem de máquina tem contribuído para a investigação de
diferentes métodos para essa finalidade. Contudo, a maioria deles concentra-se em distinguir
os períodos interictal (longe do surto) e pré-ictal (próximo ao surto) a partir dos sinais de
eletroencefalograma (EEG) do paciente. Mas a possível indicação de um surto a partir de um
método binário é imprecisa em relação ao tempo que falta para o surto acontecer. Por essa razão,
neste trabalho, é investigado um método alternativo baseado em máquinas de vetores de suporte
(SVM) no modo regressão (SVR), o qual permite à máquina aprender a relação entre duas
funções do tempo e indicar um valor real em sua saída associado ao tempo restante para o surto.
Para isso, foram testados quatro métodos de montagem de vetores da SVR, sendo eles: amostras
temporais do EEG médio; análise espectral; Wavelet Haar e Wavelet Daubechies db4. Os três
primeiros apresentaram baixa correlação entre a função de previsão e a função aprendida pela
SVR. O quarto método, por outro lado, obteve correlações de até 100%, indicando a capacidade
da SVR prever a proximidade de um surto, porém a acurácia não foi mantida quando o método
foi aplicado em outros surtos do mesmo paciente, o que requer ainda novos aperfeiçoamentos
em trabalho futuro.</p>
