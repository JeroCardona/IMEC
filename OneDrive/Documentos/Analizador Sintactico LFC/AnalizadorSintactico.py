# gramatica ejemplo
from inspect import ClosureVars


grammar = {
    'S': ['E'],
    'E': ['TX'],
    'X': ['+TX','e'],
    'T': ['FY'],
    'Y': ['*FY','e'],
    'F': ['(E)','i']
    
}

terminals = ['(',')','i','*','+','e']
non_terminal = list(grammar.keys())
print(non_terminal)

def calcular_conjunto_items(grammar):
    conjunto_items = set()
    
    def closure(item):
        non_terminal = item[1][item[2]]
        if non_terminal in grammar:
            productions = grammar[non_terminal]
            for production in productions:
                new_item = (non_terminal, tuple(production), 0)
                if new_item not in conjunto_items:
                    conjunto_items.add(new_item)
                    closure(new_item)

    for non_terminal, productions in grammar.items():
        for production in productions:
            items = [(non_terminal, tuple(production), 0)]

            for i in range(len(items)):
                item = items[i]
                conjunto_items.add(item)

                if item[2] < len(item[1]):
                    symbol = item[1][item[2]]
                    if symbol in grammar:
                        closure(item)
                    items[i] = (item[0], item[1], item[2] + 1)

    return conjunto_items


def imprimir_conjunto_items(conjunto_items):
    estados = {}
    for item in conjunto_items:
        estado = item[2]
        if estado not in estados:
            estados[estado] = []
        estados[estado].append(item)

    for estado, items in estados.items():
        print(f"Set de items")
        for item in items:
            print(f"{item[0]} -> {' '.join(item[1][:item[2]])} ● {' '.join(item[1][item[2]:])}")
    print("")
print("")


conjunto_items = calcular_conjunto_items(grammar)
imprimir_conjunto_items(conjunto_items)

def construir_tabla_LR0(grammar):
    conjunto_items = calcular_conjunto_items(grammar)
    tabla_LR0 = {}

    def ir_a(conjunto_items, symbol):
        nuevo_conjunto_items = set()
        for item in conjunto_items:
            A, alpha, dot = item
            if dot < len(alpha) and alpha[dot] == symbol:
                nuevo_conjunto_items.add((A, alpha, dot + 1))
        return nuevo_conjunto_items

    estado_inicial = conjunto_items
    estados = [estado_inicial]
    i = 0

    while i < len(estados):
        estado = estados[i]
        for item in estado:
            A, alpha, dot = item
            if dot < len(alpha):
                symbol = alpha[dot]
                nuevo_estado = ir_a(estado, symbol)
                if nuevo_estado not in estados:
                    estados.append(nuevo_estado)
                if i not in tabla_LR0:
                    tabla_LR0[i] = {}
                if symbol not in tabla_LR0[i]:
                    tabla_LR0[i][symbol] = len(estados) - 1

        i += 1

    return tabla_LR0

tabla_LR0 = construir_tabla_LR0(grammar)



#Hasta aqui bien-----------------------------------

def construir_tabla_LR0(grammar):
    conjunto_items = calcular_conjunto_items(grammar)
    tabla_LR0 = {}

    def closure(item, closure_set):
        non_terminal = item[1][item[2]]
        if non_terminal in grammar:
            productions = grammar[non_terminal]
            for production in productions:
                new_item = (non_terminal, tuple(production), 0)
                if new_item not in closure_set:
                    closure_set.add(new_item)
                    closure(new_item, closure_set)

    def ir_a(conjunto_items, symbol):
        nuevo_conjunto_items = set()
        for item in conjunto_items:
            A, alpha, dot = item
            if dot < len(alpha) and alpha[dot] == symbol:
                nuevo_conjunto_items.add((A, alpha, dot + 1))
        return nuevo_conjunto_items

    estado_inicial = conjunto_items
    estados = [estado_inicial]
    i = 0

    while i < len(estados):
        estado = estados[i]
        for item in estado:
            A, alpha, dot = item
            if dot < len(alpha):
                symbol = alpha[dot]
                nuevo_estado = ir_a(estado, symbol)
                if nuevo_estado not in estados:
                    estados.append(nuevo_estado)
                if i not in tabla_LR0:
                    tabla_LR0[i] = {}
                if symbol not in tabla_LR0[i]:
                    tabla_LR0[i][symbol] = len(estados) - 1

        i += 1

    for estado, conjunto_items in enumerate(estados):
        print(f"Estado {estado}:")
        for item in conjunto_items:
            print(f"{item[0]} -> {' '.join(item[1][:item[2]])} ● {' '.join(item[1][item[2]:])}")
            #si el punto esta antes de un simbolo no terminal se imprime el conjunto de items del simbolo no terminal
            if estado>0 and item[2] < len(item[1]) and item[1][item[2]] in grammar:
                if item[2] < len(item[1]) and item[1][item[2]] in grammar:
                 print(f"Closure del no terminal: {item[1][item[2]]}")
                 closure_set = set()
                 closure(item, closure_set)
                for item in closure_set:
                     print(f"{item[0]} -> {' '.join(item[1][:item[2]])} ● {' '.join(item[1][item[2]:])}")
                     
             #si no hay punto, es un item final y se imprime la regla de derivacion del item
            if item[2] == len(item[1]):
                 print(f"Es un item aceptado")
                 #se imprime la regla de derivacion del item
                 print(f"Reduce en la regla: {item[0]} -> {' '.join(item[1])}")
        print("")
                

                    
                    


    return conjunto_items, tabla_LR0


conjunto_items, tabla_LR0 = construir_tabla_LR0(grammar)

print("")

# Imprimir la tabla LR(0) canónica
print("Tabla LR(0) canónica:")
for estado, transiciones in tabla_LR0.items():
    print(f"Estado {estado}:")
    for symbol, estado_destino in transiciones.items():
        print(f"{symbol}: Ir a Estado {estado_destino}")