        @extends('principal')
        @section('contenido')

        @if(Auth::check())
            @if(Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <h1>Escritorio</h1>
            </template>

            <template v-if="menu==1">
               <finca></finca>
            </template>

            <template v-if="menu==2">
                <cultivo></cultivo>
            </template>

            <template v-if="menu==3">
                <productor></productor>
            </template>
            
            <template v-if="menu==4">
                <encuestafitosanitaria></encuestafitosanitaria>
            </template>

            <template v-if="menu==5">
                <venta></venta>
            </template>

            <template v-if="menu==6">
            <categoriamora></categoriamora>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template>

            <template v-if="menu==8">
                <rol></rol>
            </template>

            <template v-if="menu==9">
                <h1>Contenido del menú 9</h1>
            </template>

            <template v-if="menu==10">
               <h1>Contenido del menú 10</h1>
            </template>

            <template v-if="menu==19">
               <visita></visita>
            </template>

            <template v-if="menu==23">
                <lugarventa></lugarventa>
            </template>
            @elseif(Auth::user()->idrol == 2)
            <template v-if="menu==5">
            <venta></venta>
            </template>   
            @elseif(Auth::user()->idrol == 3)
            <template v-if="menu==1">
                <finca></finca>
            </template>
            <template v-if="menu==2">
                <cultivo></cultivo>
            </template>
            <template v-if="menu==3">
                <productor></productor>
            </template>    
            @elseif(Auth::user()->idrol == 4)
            <template v-if="menu==1">
                <finca></finca>
            </template>

            <template v-if="menu==2">
                <<cultivo></cultivo>
            </template>

            <template v-if="menu==3">
                <productor></productor>
            </template>

            <template v-if="menu==4">
                <encuestafitosanitaria></encuestafitosanitaria>
            </template>

            <template v-if="menu==5">
            <venta></venta>
            </template>
            @else
            @endif
        @endif
    @endsection