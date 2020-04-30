PGDMP     4        
            x            agrosyst    11.4    11.4 t   O           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            P           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            Q           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            R           1262    33723    agrosyst    DATABASE     �   CREATE DATABASE agrosyst WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Colombia.1252' LC_CTYPE = 'Spanish_Colombia.1252';
    DROP DATABASE agrosyst;
             postgres    false            �            1259    33724    act_con    TABLE     j   CREATE TABLE public.act_con (
    cod_con integer NOT NULL,
    ide_ter character varying(15) NOT NULL
);
    DROP TABLE public.act_con;
       public         postgres    false            �            1259    33727    act_cul    TABLE     j   CREATE TABLE public.act_cul (
    cod_cul integer NOT NULL,
    ide_ter character varying(15) NOT NULL
);
    DROP TABLE public.act_cul;
       public         postgres    false                       1259    36172    afeccion    TABLE     �  CREATE TABLE public.afeccion (
    cod_afe character varying(6) NOT NULL,
    nom_afe character varying(30) NOT NULL,
    noc_afe character varying(50) NOT NULL,
    inc_afe date NOT NULL,
    sin_afe character varying(300) NOT NULL,
    par_afe character varying(50) NOT NULL,
    epo_afe character varying(10) NOT NULL,
    tcv_afe character varying(20) NOT NULL,
    prv_afe character varying(500) NOT NULL,
    aet_afe character varying(15) NOT NULL,
    hat_afe character varying(15) NOT NULL
);
    DROP TABLE public.afeccion;
       public         postgres    false                       1259    36137 	   agr_x_eag    TABLE     x   CREATE TABLE public.agr_x_eag (
    cod_eag character varying(6) NOT NULL,
    cod_agr character varying(6) NOT NULL
);
    DROP TABLE public.agr_x_eag;
       public         postgres    false                       1259    36157 	   agr_x_mol    TABLE     �   CREATE TABLE public.agr_x_mol (
    cod_agr character varying(6) NOT NULL,
    cod_mol character varying(6) NOT NULL,
    cac_agr character varying(6)
);
    DROP TABLE public.agr_x_mol;
       public         postgres    false                       1259    36112    agroquimicos    TABLE     �  CREATE TABLE public.agroquimicos (
    cod_agr character varying(6) NOT NULL,
    cod_ins integer NOT NULL,
    det_agr character varying(50) NOT NULL,
    rec_agr character varying(50) NOT NULL,
    pcr_agr character varying(10) NOT NULL,
    pen_agr character varying(10) NOT NULL,
    pro_agr character varying(10) NOT NULL,
    for_agr character varying(15) NOT NULL,
    cod_tag character varying(6) NOT NULL,
    cod_tox character varying(6) NOT NULL,
    est_agr character varying(15) NOT NULL
);
     DROP TABLE public.agroquimicos;
       public         postgres    false                       1259    35116    cliente    TABLE     j   CREATE TABLE public.cliente (
    ide_ter character varying(15) NOT NULL,
    cod_cli integer NOT NULL
);
    DROP TABLE public.cliente;
       public         postgres    false                       1259    35126    cliente_cod_cli_seq    SEQUENCE     �   CREATE SEQUENCE public.cliente_cod_cli_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.cliente_cod_cli_seq;
       public       postgres    false    269            S           0    0    cliente_cod_cli_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.cliente_cod_cli_seq OWNED BY public.cliente.cod_cli;
            public       postgres    false    270            �            1259    33735    comprar    TABLE     j   CREATE TABLE public.comprar (
    cod_com integer NOT NULL,
    ide_ter character varying(15) NOT NULL
);
    DROP TABLE public.comprar;
       public         postgres    false            �            1259    33738    compras    TABLE     n   CREATE TABLE public.compras (
    cod_com integer NOT NULL,
    fec_com date NOT NULL,
    tot_com integer
);
    DROP TABLE public.compras;
       public         postgres    false            �            1259    33741    compras_cod_com_seq    SEQUENCE     �   CREATE SEQUENCE public.compras_cod_com_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.compras_cod_com_seq;
       public       postgres    false    199            T           0    0    compras_cod_com_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.compras_cod_com_seq OWNED BY public.compras.cod_com;
            public       postgres    false    200            �            1259    33743    comun    TABLE     Q   CREATE TABLE public.comun (
    cod_cun integer NOT NULL,
    cod_tar integer
);
    DROP TABLE public.comun;
       public         postgres    false            �            1259    33746    comun_cod_cun_seq    SEQUENCE     �   CREATE SEQUENCE public.comun_cod_cun_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.comun_cod_cun_seq;
       public       postgres    false    201            U           0    0    comun_cod_cun_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.comun_cod_cun_seq OWNED BY public.comun.cod_cun;
            public       postgres    false    202            �            1259    33748 	   contratos    TABLE     �   CREATE TABLE public.contratos (
    cod_cot integer NOT NULL,
    val_cot integer,
    des_cot character varying(45),
    cod_con integer,
    ffi_con date
);
    DROP TABLE public.contratos;
       public         postgres    false            �            1259    33751    contratos_cod_cot_seq    SEQUENCE     �   CREATE SEQUENCE public.contratos_cod_cot_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.contratos_cod_cot_seq;
       public       postgres    false    203            V           0    0    contratos_cod_cot_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.contratos_cod_cot_seq OWNED BY public.contratos.cod_cot;
            public       postgres    false    204            �            1259    33753    convenio    TABLE     Z   CREATE TABLE public.convenio (
    cod_con integer NOT NULL,
    fec_con date NOT NULL
);
    DROP TABLE public.convenio;
       public         postgres    false            �            1259    33756    convenio_cod_con_seq    SEQUENCE     �   CREATE SEQUENCE public.convenio_cod_con_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.convenio_cod_con_seq;
       public       postgres    false    205            W           0    0    convenio_cod_con_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.convenio_cod_con_seq OWNED BY public.convenio.cod_con;
            public       postgres    false    206            �            1259    33758    cultivos    TABLE     s  CREATE TABLE public.cultivos (
    cod_cul integer NOT NULL,
    fin_cul date NOT NULL,
    fif_cul date,
    npl_cul integer,
    tip_cul character varying(11) NOT NULL,
    dur_cul character varying(25) NOT NULL,
    est_cul character varying(45) NOT NULL,
    cod_ncu integer,
    cod_lot integer,
    dia_cul character varying(6),
    mod_cul character varying(5)
);
    DROP TABLE public.cultivos;
       public         postgres    false            �            1259    33761    cultivos_cod_cul_seq    SEQUENCE     �   CREATE SEQUENCE public.cultivos_cod_cul_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.cultivos_cod_cul_seq;
       public       postgres    false    207            X           0    0    cultivos_cod_cul_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.cultivos_cod_cul_seq OWNED BY public.cultivos.cod_cul;
            public       postgres    false    208            �            1259    33763    cultural    TABLE     T   CREATE TABLE public.cultural (
    cod_cut integer NOT NULL,
    cod_tar integer
);
    DROP TABLE public.cultural;
       public         postgres    false            �            1259    33766    cultural_cod_cut_seq    SEQUENCE     �   CREATE SEQUENCE public.cultural_cod_cut_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.cultural_cod_cut_seq;
       public       postgres    false    209            Y           0    0    cultural_cod_cut_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.cultural_cod_cut_seq OWNED BY public.cultural.cod_cut;
            public       postgres    false    210            �            1259    33768    departamento    TABLE     |   CREATE TABLE public.departamento (
    cod_dep character varying(2) NOT NULL,
    nom_dep character varying(60) NOT NULL
);
     DROP TABLE public.departamento;
       public         postgres    false            �            1259    33771    desarrollar    TABLE     N   CREATE TABLE public.desarrollar (
    cod_tar integer,
    cod_lab integer
);
    DROP TABLE public.desarrollar;
       public         postgres    false            �            1259    33774    dueño    TABLE     b   CREATE TABLE public."dueño" (
    cod_due integer NOT NULL,
    ide_ter character varying(15)
);
    DROP TABLE public."dueño";
       public         postgres    false            �            1259    33777    dueño_cod_due_seq    SEQUENCE     �   CREATE SEQUENCE public."dueño_cod_due_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public."dueño_cod_due_seq";
       public       postgres    false    213            Z           0    0    dueño_cod_due_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public."dueño_cod_due_seq" OWNED BY public."dueño".cod_due;
            public       postgres    false    214            �            1259    33779    efectuar    TABLE     K   CREATE TABLE public.efectuar (
    cod_con integer,
    cod_tar integer
);
    DROP TABLE public.efectuar;
       public         postgres    false            �            1259    33782    ejecutar    TABLE     ]   CREATE TABLE public.ejecutar (
    cod_con integer NOT NULL,
    cod_cul integer NOT NULL
);
    DROP TABLE public.ejecutar;
       public         postgres    false            �            1259    33785    email_tercero    TABLE        CREATE TABLE public.email_tercero (
    ide_ter character varying(15) NOT NULL,
    ema_ter character varying(100) NOT NULL
);
 !   DROP TABLE public.email_tercero;
       public         postgres    false                       1259    36180    enfermedades    TABLE     �   CREATE TABLE public.enfermedades (
    cod_afe character varying(6) NOT NULL,
    cod_enf character varying(6) NOT NULL,
    pat_enf character varying(50) NOT NULL
);
     DROP TABLE public.enfermedades;
       public         postgres    false                       1259    36132    estado_agroquimico    TABLE     �   CREATE TABLE public.estado_agroquimico (
    cod_eag character varying(6) NOT NULL,
    det_eag character varying(15) NOT NULL
);
 &   DROP TABLE public.estado_agroquimico;
       public         postgres    false                       1259    36205 	   eta_x_afe    TABLE     x   CREATE TABLE public.eta_x_afe (
    cod_afe character varying(6) NOT NULL,
    cod_eta character varying(6) NOT NULL
);
    DROP TABLE public.eta_x_afe;
       public         postgres    false                       1259    36200    etapas_crecimiento    TABLE     �   CREATE TABLE public.etapas_crecimiento (
    cod_eta character varying(6) NOT NULL,
    det_eta character varying(50) NOT NULL,
    ima_eta character varying(100) NOT NULL
);
 &   DROP TABLE public.etapas_crecimiento;
       public         postgres    false            �            1259    33788    fincas    TABLE     {  CREATE TABLE public.fincas (
    cod_fin character varying(20) NOT NULL,
    nom_fin character varying(45) NOT NULL,
    det_fin text,
    cod_dep character varying(2),
    cod_mun character varying(3),
    ide_ter character varying(15),
    cod_unm integer,
    med_fin character varying(5) NOT NULL,
    cnt_fin integer NOT NULL,
    fot_fin character varying(300) NOT NULL
);
    DROP TABLE public.fincas;
       public         postgres    false            �            1259    33794    fincas_cnt_fin_seq    SEQUENCE     �   CREATE SEQUENCE public.fincas_cnt_fin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.fincas_cnt_fin_seq;
       public       postgres    false    218            [           0    0    fincas_cnt_fin_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.fincas_cnt_fin_seq OWNED BY public.fincas.cnt_fin;
            public       postgres    false    219            �            1259    33796    fitosanitaria    TABLE     �   CREATE TABLE public.fitosanitaria (
    cod_fit integer NOT NULL,
    enf_fit character varying(45) NOT NULL,
    cod_tar integer
);
 !   DROP TABLE public.fitosanitaria;
       public         postgres    false            �            1259    33799    fitosanitaria_cod_fit_seq    SEQUENCE     �   CREATE SEQUENCE public.fitosanitaria_cod_fit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.fitosanitaria_cod_fit_seq;
       public       postgres    false    220            \           0    0    fitosanitaria_cod_fit_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.fitosanitaria_cod_fit_seq OWNED BY public.fitosanitaria.cod_fit;
            public       postgres    false    221            �            1259    33801    gozar    TABLE     �   CREATE TABLE public.gozar (
    cod_tpr integer NOT NULL,
    cod_pro integer NOT NULL,
    fec_goz date NOT NULL,
    ctp_goz integer,
    pre_goz integer,
    cpt_goz character varying
);
    DROP TABLE public.gozar;
       public         postgres    false            �            1259    33804    insumos    TABLE        CREATE TABLE public.insumos (
    cod_ins integer NOT NULL,
    des_ins character varying(45) NOT NULL,
    cod_unm integer
);
    DROP TABLE public.insumos;
       public         postgres    false            �            1259    33807    insumos_cod_ins_seq    SEQUENCE     �   CREATE SEQUENCE public.insumos_cod_ins_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.insumos_cod_ins_seq;
       public       postgres    false    223            ]           0    0    insumos_cod_ins_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.insumos_cod_ins_seq OWNED BY public.insumos.cod_ins;
            public       postgres    false    224            �            1259    33809    jornales    TABLE     ~   CREATE TABLE public.jornales (
    cod_jor integer NOT NULL,
    hor_jor integer,
    vho_jor integer,
    cod_con integer
);
    DROP TABLE public.jornales;
       public         postgres    false            �            1259    33812    jornales_cod_jor_seq    SEQUENCE     �   CREATE SEQUENCE public.jornales_cod_jor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.jornales_cod_jor_seq;
       public       postgres    false    225            ^           0    0    jornales_cod_jor_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.jornales_cod_jor_seq OWNED BY public.jornales.cod_jor;
            public       postgres    false    226            �            1259    33814    labores    TABLE     �   CREATE TABLE public.labores (
    cod_lab integer NOT NULL,
    nom_lab character varying(45) NOT NULL,
    det_lab character varying(300)
);
    DROP TABLE public.labores;
       public         postgres    false            �            1259    33817    labores_cod_lab_seq    SEQUENCE     �   CREATE SEQUENCE public.labores_cod_lab_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.labores_cod_lab_seq;
       public       postgres    false    227            _           0    0    labores_cod_lab_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.labores_cod_lab_seq OWNED BY public.labores.cod_lab;
            public       postgres    false    228            �            1259    33819    lotes    TABLE     �   CREATE TABLE public.lotes (
    cod_lot integer NOT NULL,
    nom_lot character varying(45) NOT NULL,
    cod_fin character varying(20),
    cod_unm integer,
    med_lot character varying(5) NOT NULL
);
    DROP TABLE public.lotes;
       public         postgres    false            �            1259    33822    lotes_cod_lot_seq    SEQUENCE     �   CREATE SEQUENCE public.lotes_cod_lot_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.lotes_cod_lot_seq;
       public       postgres    false    229            `           0    0    lotes_cod_lot_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.lotes_cod_lot_seq OWNED BY public.lotes.cod_lot;
            public       postgres    false    230                       1259    36220 	   mol_x_afe    TABLE     �   CREATE TABLE public.mol_x_afe (
    cod_mol character varying(6) NOT NULL,
    cod_afe character varying(6) NOT NULL,
    cod_eta character varying(6) NOT NULL
);
    DROP TABLE public.mol_x_afe;
       public         postgres    false                       1259    36152 	   moleculas    TABLE     �   CREATE TABLE public.moleculas (
    cod_mol character varying(6) NOT NULL,
    des_mol character varying(50) NOT NULL,
    pro_mol character varying(3) NOT NULL
);
    DROP TABLE public.moleculas;
       public         postgres    false            �            1259    33824 	   municipio    TABLE     �   CREATE TABLE public.municipio (
    cod_mun character varying(4) NOT NULL,
    nom_mun character varying(45) NOT NULL,
    cod_dep character varying(2)
);
    DROP TABLE public.municipio;
       public         postgres    false            �            1259    33827    nombre_cultivo    TABLE     q   CREATE TABLE public.nombre_cultivo (
    cod_ncu integer NOT NULL,
    des_ncu character varying(45) NOT NULL
);
 "   DROP TABLE public.nombre_cultivo;
       public         postgres    false            �            1259    33830    nombre_cultivo_cod_ncu_seq    SEQUENCE     �   CREATE SEQUENCE public.nombre_cultivo_cod_ncu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.nombre_cultivo_cod_ncu_seq;
       public       postgres    false    232            a           0    0    nombre_cultivo_cod_ncu_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.nombre_cultivo_cod_ncu_seq OWNED BY public.nombre_cultivo.cod_ncu;
            public       postgres    false    233            �            1259    33832    otros    TABLE     t   CREATE TABLE public.otros (
    cod_otr integer NOT NULL,
    cod_ins integer,
    det_otr character varying(50)
);
    DROP TABLE public.otros;
       public         postgres    false            �            1259    33835    otros_cod_otr_seq    SEQUENCE     �   CREATE SEQUENCE public.otros_cod_otr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.otros_cod_otr_seq;
       public       postgres    false    234            b           0    0    otros_cod_otr_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.otros_cod_otr_seq OWNED BY public.otros.cod_otr;
            public       postgres    false    235                       1259    36190    plagas    TABLE     �   CREATE TABLE public.plagas (
    cod_afe character varying(6) NOT NULL,
    cod_plg character varying(6) NOT NULL,
    tip_plg character varying(50) NOT NULL
);
    DROP TABLE public.plagas;
       public         postgres    false                       1259    36240    planificacion    TABLE     �   CREATE TABLE public.planificacion (
    cod_pla character varying(6) NOT NULL,
    fec_pla date NOT NULL,
    epo_pla character varying(100) NOT NULL
);
 !   DROP TABLE public.planificacion;
       public         postgres    false            �            1259    33837    pre_sto    TABLE     �   CREATE TABLE public.pre_sto (
    fec_cin character varying(30) NOT NULL,
    cod_sto integer NOT NULL,
    pre_sto integer,
    cod_pre integer NOT NULL
);
    DROP TABLE public.pre_sto;
       public         postgres    false                       1259    44469    pre_sto_cod_pre_seq    SEQUENCE     �   CREATE SEQUENCE public.pre_sto_cod_pre_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.pre_sto_cod_pre_seq;
       public       postgres    false    236            c           0    0    pre_sto_cod_pre_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pre_sto_cod_pre_seq OWNED BY public.pre_sto.cod_pre;
            public       postgres    false    286            �            1259    33840 
   produccion    TABLE     y   CREATE TABLE public.produccion (
    cod_pro integer NOT NULL,
    cod_cul integer,
    ide_ter character varying(15)
);
    DROP TABLE public.produccion;
       public         postgres    false            �            1259    33843    produccion_cod_pro_seq    SEQUENCE     �   CREATE SEQUENCE public.produccion_cod_pro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.produccion_cod_pro_seq;
       public       postgres    false    237            d           0    0    produccion_cod_pro_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.produccion_cod_pro_seq OWNED BY public.produccion.cod_pro;
            public       postgres    false    238            �            1259    33845 	   proveedor    TABLE     c   CREATE TABLE public.proveedor (
    cod_pro integer NOT NULL,
    ide_ter character varying(15)
);
    DROP TABLE public.proveedor;
       public         postgres    false            �            1259    33848    proveedor_cod_pro_seq    SEQUENCE     �   CREATE SEQUENCE public.proveedor_cod_pro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.proveedor_cod_pro_seq;
       public       postgres    false    239            e           0    0    proveedor_cod_pro_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.proveedor_cod_pro_seq OWNED BY public.proveedor.cod_pro;
            public       postgres    false    240            �            1259    33850 	   registrar    TABLE     ^   CREATE TABLE public.registrar (
    cod_com integer NOT NULL,
    cod_sto integer NOT NULL
);
    DROP TABLE public.registrar;
       public         postgres    false            �            1259    33853    semillas    TABLE     �   CREATE TABLE public.semillas (
    cod_sem integer NOT NULL,
    cod_ins integer,
    cod_tsa integer,
    det_sem character varying(50)
);
    DROP TABLE public.semillas;
       public         postgres    false            �            1259    33856    semillas_cod_sem_seq    SEQUENCE     �   CREATE SEQUENCE public.semillas_cod_sem_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.semillas_cod_sem_seq;
       public       postgres    false    242            f           0    0    semillas_cod_sem_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.semillas_cod_sem_seq OWNED BY public.semillas.cod_sem;
            public       postgres    false    243            �            1259    33858 	   semillero    TABLE     �   CREATE TABLE public.semillero (
    cod_smr integer NOT NULL,
    cod_ins integer,
    cod_tso integer,
    det_smr character varying(50)
);
    DROP TABLE public.semillero;
       public         postgres    false            �            1259    33861    semillero_cod_smr_seq    SEQUENCE     �   CREATE SEQUENCE public.semillero_cod_smr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.semillero_cod_smr_seq;
       public       postgres    false    244            g           0    0    semillero_cod_smr_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.semillero_cod_smr_seq OWNED BY public.semillero.cod_smr;
            public       postgres    false    245            �            1259    33863    socio    TABLE     _   CREATE TABLE public.socio (
    cod_soc integer NOT NULL,
    ide_ter character varying(15)
);
    DROP TABLE public.socio;
       public         postgres    false            �            1259    33866    socio_cod_soc_seq    SEQUENCE     �   CREATE SEQUENCE public.socio_cod_soc_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.socio_cod_soc_seq;
       public       postgres    false    246            h           0    0    socio_cod_soc_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.socio_cod_soc_seq OWNED BY public.socio.cod_soc;
            public       postgres    false    247            �            1259    33868    stock    TABLE     f   CREATE TABLE public.stock (
    cod_sto integer NOT NULL,
    can_sto integer,
    cod_ins integer
);
    DROP TABLE public.stock;
       public         postgres    false            �            1259    33871    stock_cod_sto_seq    SEQUENCE     �   CREATE SEQUENCE public.stock_cod_sto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.stock_cod_sto_seq;
       public       postgres    false    248            i           0    0    stock_cod_sto_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.stock_cod_sto_seq OWNED BY public.stock.cod_sto;
            public       postgres    false    249            �            1259    33873    tarea    TABLE     �   CREATE TABLE public.tarea (
    cod_tar integer NOT NULL,
    fin_tar date NOT NULL,
    ffi_tar date,
    val_tar integer,
    des_tar character varying(45)
);
    DROP TABLE public.tarea;
       public         postgres    false            �            1259    33876    tarea_cod_tar_seq    SEQUENCE     �   CREATE SEQUENCE public.tarea_cod_tar_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.tarea_cod_tar_seq;
       public       postgres    false    250            j           0    0    tarea_cod_tar_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.tarea_cod_tar_seq OWNED BY public.tarea.cod_tar;
            public       postgres    false    251            �            1259    33878    tel_tercero    TABLE     |   CREATE TABLE public.tel_tercero (
    ide_ter character varying(15) NOT NULL,
    tel_ter character varying(11) NOT NULL
);
    DROP TABLE public.tel_tercero;
       public         postgres    false            �            1259    33881    terceros    TABLE     �   CREATE TABLE public.terceros (
    ide_ter character varying(15) NOT NULL,
    pno_ter character varying(20) NOT NULL,
    sno_ter character varying(20) NOT NULL,
    pap_ter character varying(20) NOT NULL,
    sap_ter character varying(20) NOT NULL
);
    DROP TABLE public.terceros;
       public         postgres    false                       1259    36107    tipo_agroquimico    TABLE     �   CREATE TABLE public.tipo_agroquimico (
    cod_tag character varying(6) NOT NULL,
    det_tag character varying(20) NOT NULL
);
 $   DROP TABLE public.tipo_agroquimico;
       public         postgres    false            �            1259    33884    tipo_de_produccion    TABLE     �   CREATE TABLE public.tipo_de_produccion (
    cod_tpr integer NOT NULL,
    des_tpr character varying(45) NOT NULL,
    cod_unm integer
);
 &   DROP TABLE public.tipo_de_produccion;
       public         postgres    false            �            1259    33887    tipo_de_produccion_cod_tpr_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_de_produccion_cod_tpr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tipo_de_produccion_cod_tpr_seq;
       public       postgres    false    254            k           0    0    tipo_de_produccion_cod_tpr_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tipo_de_produccion_cod_tpr_seq OWNED BY public.tipo_de_produccion.cod_tpr;
            public       postgres    false    255                        1259    33889    tipo_semilla    TABLE     o   CREATE TABLE public.tipo_semilla (
    cod_tsa integer NOT NULL,
    det_tsa character varying(20) NOT NULL
);
     DROP TABLE public.tipo_semilla;
       public         postgres    false                       1259    33892    tipo_semilla_cod_tsa_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_semilla_cod_tsa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.tipo_semilla_cod_tsa_seq;
       public       postgres    false    256            l           0    0    tipo_semilla_cod_tsa_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.tipo_semilla_cod_tsa_seq OWNED BY public.tipo_semilla.cod_tsa;
            public       postgres    false    257                       1259    33894    tipo_semillero    TABLE     q   CREATE TABLE public.tipo_semillero (
    cod_tso integer NOT NULL,
    det_tso character varying(20) NOT NULL
);
 "   DROP TABLE public.tipo_semillero;
       public         postgres    false                       1259    33897    tipo_semillero_cod_tso_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_semillero_cod_tso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tipo_semillero_cod_tso_seq;
       public       postgres    false    258            m           0    0    tipo_semillero_cod_tso_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tipo_semillero_cod_tso_seq OWNED BY public.tipo_semillero.cod_tso;
            public       postgres    false    259                       1259    33899    tipo_unidad_medida    TABLE     u   CREATE TABLE public.tipo_unidad_medida (
    cod_tum integer NOT NULL,
    des_tum character varying(45) NOT NULL
);
 &   DROP TABLE public.tipo_unidad_medida;
       public         postgres    false                       1259    33902    tipo_unidad_medida_cod_tum_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_unidad_medida_cod_tum_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tipo_unidad_medida_cod_tum_seq;
       public       postgres    false    260            n           0    0    tipo_unidad_medida_cod_tum_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tipo_unidad_medida_cod_tum_seq OWNED BY public.tipo_unidad_medida.cod_tum;
            public       postgres    false    261                       1259    36102 	   toxicidad    TABLE     �   CREATE TABLE public.toxicidad (
    cod_tox character varying(6) NOT NULL,
    det_tox character varying(20) NOT NULL,
    col_tox character varying(10) NOT NULL
);
    DROP TABLE public.toxicidad;
       public         postgres    false                       1259    33904 
   trabajador    TABLE     d   CREATE TABLE public.trabajador (
    cod_tra integer NOT NULL,
    ide_ter character varying(15)
);
    DROP TABLE public.trabajador;
       public         postgres    false                       1259    33907    trabajador_cod_tra_seq    SEQUENCE     �   CREATE SEQUENCE public.trabajador_cod_tra_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.trabajador_cod_tra_seq;
       public       postgres    false    262            o           0    0    trabajador_cod_tra_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.trabajador_cod_tra_seq OWNED BY public.trabajador.cod_tra;
            public       postgres    false    263                       1259    33909    unidad_de_medida    TABLE     �   CREATE TABLE public.unidad_de_medida (
    cod_unm integer NOT NULL,
    des_unm character varying(30) NOT NULL,
    cod_tum integer,
    equ_med bigint
);
 $   DROP TABLE public.unidad_de_medida;
       public         postgres    false            	           1259    33912    unidad_de_medida_cod_unm_seq    SEQUENCE     �   CREATE SEQUENCE public.unidad_de_medida_cod_unm_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.unidad_de_medida_cod_unm_seq;
       public       postgres    false    264            p           0    0    unidad_de_medida_cod_unm_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.unidad_de_medida_cod_unm_seq OWNED BY public.unidad_de_medida.cod_unm;
            public       postgres    false    265            
           1259    33914    usuario    TABLE     �   CREATE TABLE public.usuario (
    id_usu integer NOT NULL,
    usu_usu character varying(20),
    pas_usu character varying(20)
);
    DROP TABLE public.usuario;
       public         postgres    false                       1259    33917    usuario_id_usu_seq    SEQUENCE     �   CREATE SEQUENCE public.usuario_id_usu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.usuario_id_usu_seq;
       public       postgres    false    266            q           0    0    usuario_id_usu_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.usuario_id_usu_seq OWNED BY public.usuario.id_usu;
            public       postgres    false    267                       1259    33919    utilizar    TABLE     �   CREATE TABLE public.utilizar (
    cod_sto integer NOT NULL,
    cod_tar integer NOT NULL,
    cin_tar integer NOT NULL,
    pin_tar character varying(8),
    cod_uti integer NOT NULL
);
    DROP TABLE public.utilizar;
       public         postgres    false                       1259    44461    utilizar_cod_uti_seq    SEQUENCE     �   CREATE SEQUENCE public.utilizar_cod_uti_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.utilizar_cod_uti_seq;
       public       postgres    false    268            r           0    0    utilizar_cod_uti_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.utilizar_cod_uti_seq OWNED BY public.utilizar.cod_uti;
            public       postgres    false    285            �           2604    35128    cliente cod_cli    DEFAULT     r   ALTER TABLE ONLY public.cliente ALTER COLUMN cod_cli SET DEFAULT nextval('public.cliente_cod_cli_seq'::regclass);
 >   ALTER TABLE public.cliente ALTER COLUMN cod_cli DROP DEFAULT;
       public       postgres    false    270    269            �           2604    33923    compras cod_com    DEFAULT     r   ALTER TABLE ONLY public.compras ALTER COLUMN cod_com SET DEFAULT nextval('public.compras_cod_com_seq'::regclass);
 >   ALTER TABLE public.compras ALTER COLUMN cod_com DROP DEFAULT;
       public       postgres    false    200    199            �           2604    33924    comun cod_cun    DEFAULT     n   ALTER TABLE ONLY public.comun ALTER COLUMN cod_cun SET DEFAULT nextval('public.comun_cod_cun_seq'::regclass);
 <   ALTER TABLE public.comun ALTER COLUMN cod_cun DROP DEFAULT;
       public       postgres    false    202    201            �           2604    33925    contratos cod_cot    DEFAULT     v   ALTER TABLE ONLY public.contratos ALTER COLUMN cod_cot SET DEFAULT nextval('public.contratos_cod_cot_seq'::regclass);
 @   ALTER TABLE public.contratos ALTER COLUMN cod_cot DROP DEFAULT;
       public       postgres    false    204    203            �           2604    33926    convenio cod_con    DEFAULT     t   ALTER TABLE ONLY public.convenio ALTER COLUMN cod_con SET DEFAULT nextval('public.convenio_cod_con_seq'::regclass);
 ?   ALTER TABLE public.convenio ALTER COLUMN cod_con DROP DEFAULT;
       public       postgres    false    206    205            �           2604    33927    cultivos cod_cul    DEFAULT     t   ALTER TABLE ONLY public.cultivos ALTER COLUMN cod_cul SET DEFAULT nextval('public.cultivos_cod_cul_seq'::regclass);
 ?   ALTER TABLE public.cultivos ALTER COLUMN cod_cul DROP DEFAULT;
       public       postgres    false    208    207            �           2604    33928    cultural cod_cut    DEFAULT     t   ALTER TABLE ONLY public.cultural ALTER COLUMN cod_cut SET DEFAULT nextval('public.cultural_cod_cut_seq'::regclass);
 ?   ALTER TABLE public.cultural ALTER COLUMN cod_cut DROP DEFAULT;
       public       postgres    false    210    209            �           2604    33929    dueño cod_due    DEFAULT     t   ALTER TABLE ONLY public."dueño" ALTER COLUMN cod_due SET DEFAULT nextval('public."dueño_cod_due_seq"'::regclass);
 ?   ALTER TABLE public."dueño" ALTER COLUMN cod_due DROP DEFAULT;
       public       postgres    false    214    213            �           2604    33930    fincas cnt_fin    DEFAULT     p   ALTER TABLE ONLY public.fincas ALTER COLUMN cnt_fin SET DEFAULT nextval('public.fincas_cnt_fin_seq'::regclass);
 =   ALTER TABLE public.fincas ALTER COLUMN cnt_fin DROP DEFAULT;
       public       postgres    false    219    218            �           2604    33931    fitosanitaria cod_fit    DEFAULT     ~   ALTER TABLE ONLY public.fitosanitaria ALTER COLUMN cod_fit SET DEFAULT nextval('public.fitosanitaria_cod_fit_seq'::regclass);
 D   ALTER TABLE public.fitosanitaria ALTER COLUMN cod_fit DROP DEFAULT;
       public       postgres    false    221    220            �           2604    33932    insumos cod_ins    DEFAULT     r   ALTER TABLE ONLY public.insumos ALTER COLUMN cod_ins SET DEFAULT nextval('public.insumos_cod_ins_seq'::regclass);
 >   ALTER TABLE public.insumos ALTER COLUMN cod_ins DROP DEFAULT;
       public       postgres    false    224    223            �           2604    33933    jornales cod_jor    DEFAULT     t   ALTER TABLE ONLY public.jornales ALTER COLUMN cod_jor SET DEFAULT nextval('public.jornales_cod_jor_seq'::regclass);
 ?   ALTER TABLE public.jornales ALTER COLUMN cod_jor DROP DEFAULT;
       public       postgres    false    226    225            �           2604    33934    labores cod_lab    DEFAULT     r   ALTER TABLE ONLY public.labores ALTER COLUMN cod_lab SET DEFAULT nextval('public.labores_cod_lab_seq'::regclass);
 >   ALTER TABLE public.labores ALTER COLUMN cod_lab DROP DEFAULT;
       public       postgres    false    228    227            �           2604    33935    lotes cod_lot    DEFAULT     n   ALTER TABLE ONLY public.lotes ALTER COLUMN cod_lot SET DEFAULT nextval('public.lotes_cod_lot_seq'::regclass);
 <   ALTER TABLE public.lotes ALTER COLUMN cod_lot DROP DEFAULT;
       public       postgres    false    230    229            �           2604    33936    nombre_cultivo cod_ncu    DEFAULT     �   ALTER TABLE ONLY public.nombre_cultivo ALTER COLUMN cod_ncu SET DEFAULT nextval('public.nombre_cultivo_cod_ncu_seq'::regclass);
 E   ALTER TABLE public.nombre_cultivo ALTER COLUMN cod_ncu DROP DEFAULT;
       public       postgres    false    233    232            �           2604    33937    otros cod_otr    DEFAULT     n   ALTER TABLE ONLY public.otros ALTER COLUMN cod_otr SET DEFAULT nextval('public.otros_cod_otr_seq'::regclass);
 <   ALTER TABLE public.otros ALTER COLUMN cod_otr DROP DEFAULT;
       public       postgres    false    235    234            �           2604    44471    pre_sto cod_pre    DEFAULT     r   ALTER TABLE ONLY public.pre_sto ALTER COLUMN cod_pre SET DEFAULT nextval('public.pre_sto_cod_pre_seq'::regclass);
 >   ALTER TABLE public.pre_sto ALTER COLUMN cod_pre DROP DEFAULT;
       public       postgres    false    286    236            �           2604    33938    produccion cod_pro    DEFAULT     x   ALTER TABLE ONLY public.produccion ALTER COLUMN cod_pro SET DEFAULT nextval('public.produccion_cod_pro_seq'::regclass);
 A   ALTER TABLE public.produccion ALTER COLUMN cod_pro DROP DEFAULT;
       public       postgres    false    238    237            �           2604    33939    proveedor cod_pro    DEFAULT     v   ALTER TABLE ONLY public.proveedor ALTER COLUMN cod_pro SET DEFAULT nextval('public.proveedor_cod_pro_seq'::regclass);
 @   ALTER TABLE public.proveedor ALTER COLUMN cod_pro DROP DEFAULT;
       public       postgres    false    240    239            �           2604    33940    semillas cod_sem    DEFAULT     t   ALTER TABLE ONLY public.semillas ALTER COLUMN cod_sem SET DEFAULT nextval('public.semillas_cod_sem_seq'::regclass);
 ?   ALTER TABLE public.semillas ALTER COLUMN cod_sem DROP DEFAULT;
       public       postgres    false    243    242            �           2604    33941    semillero cod_smr    DEFAULT     v   ALTER TABLE ONLY public.semillero ALTER COLUMN cod_smr SET DEFAULT nextval('public.semillero_cod_smr_seq'::regclass);
 @   ALTER TABLE public.semillero ALTER COLUMN cod_smr DROP DEFAULT;
       public       postgres    false    245    244            �           2604    33942    socio cod_soc    DEFAULT     n   ALTER TABLE ONLY public.socio ALTER COLUMN cod_soc SET DEFAULT nextval('public.socio_cod_soc_seq'::regclass);
 <   ALTER TABLE public.socio ALTER COLUMN cod_soc DROP DEFAULT;
       public       postgres    false    247    246            �           2604    33943    stock cod_sto    DEFAULT     n   ALTER TABLE ONLY public.stock ALTER COLUMN cod_sto SET DEFAULT nextval('public.stock_cod_sto_seq'::regclass);
 <   ALTER TABLE public.stock ALTER COLUMN cod_sto DROP DEFAULT;
       public       postgres    false    249    248            �           2604    33944    tarea cod_tar    DEFAULT     n   ALTER TABLE ONLY public.tarea ALTER COLUMN cod_tar SET DEFAULT nextval('public.tarea_cod_tar_seq'::regclass);
 <   ALTER TABLE public.tarea ALTER COLUMN cod_tar DROP DEFAULT;
       public       postgres    false    251    250            �           2604    33945    tipo_de_produccion cod_tpr    DEFAULT     �   ALTER TABLE ONLY public.tipo_de_produccion ALTER COLUMN cod_tpr SET DEFAULT nextval('public.tipo_de_produccion_cod_tpr_seq'::regclass);
 I   ALTER TABLE public.tipo_de_produccion ALTER COLUMN cod_tpr DROP DEFAULT;
       public       postgres    false    255    254            �           2604    33946    tipo_semilla cod_tsa    DEFAULT     |   ALTER TABLE ONLY public.tipo_semilla ALTER COLUMN cod_tsa SET DEFAULT nextval('public.tipo_semilla_cod_tsa_seq'::regclass);
 C   ALTER TABLE public.tipo_semilla ALTER COLUMN cod_tsa DROP DEFAULT;
       public       postgres    false    257    256            �           2604    33947    tipo_semillero cod_tso    DEFAULT     �   ALTER TABLE ONLY public.tipo_semillero ALTER COLUMN cod_tso SET DEFAULT nextval('public.tipo_semillero_cod_tso_seq'::regclass);
 E   ALTER TABLE public.tipo_semillero ALTER COLUMN cod_tso DROP DEFAULT;
       public       postgres    false    259    258            �           2604    33948    tipo_unidad_medida cod_tum    DEFAULT     �   ALTER TABLE ONLY public.tipo_unidad_medida ALTER COLUMN cod_tum SET DEFAULT nextval('public.tipo_unidad_medida_cod_tum_seq'::regclass);
 I   ALTER TABLE public.tipo_unidad_medida ALTER COLUMN cod_tum DROP DEFAULT;
       public       postgres    false    261    260            �           2604    33949    trabajador cod_tra    DEFAULT     x   ALTER TABLE ONLY public.trabajador ALTER COLUMN cod_tra SET DEFAULT nextval('public.trabajador_cod_tra_seq'::regclass);
 A   ALTER TABLE public.trabajador ALTER COLUMN cod_tra DROP DEFAULT;
       public       postgres    false    263    262            �           2604    33950    unidad_de_medida cod_unm    DEFAULT     �   ALTER TABLE ONLY public.unidad_de_medida ALTER COLUMN cod_unm SET DEFAULT nextval('public.unidad_de_medida_cod_unm_seq'::regclass);
 G   ALTER TABLE public.unidad_de_medida ALTER COLUMN cod_unm DROP DEFAULT;
       public       postgres    false    265    264            �           2604    33951    usuario id_usu    DEFAULT     p   ALTER TABLE ONLY public.usuario ALTER COLUMN id_usu SET DEFAULT nextval('public.usuario_id_usu_seq'::regclass);
 =   ALTER TABLE public.usuario ALTER COLUMN id_usu DROP DEFAULT;
       public       postgres    false    267    266            �           2604    44463    utilizar cod_uti    DEFAULT     t   ALTER TABLE ONLY public.utilizar ALTER COLUMN cod_uti SET DEFAULT nextval('public.utilizar_cod_uti_seq'::regclass);
 ?   ALTER TABLE public.utilizar ALTER COLUMN cod_uti DROP DEFAULT;
       public       postgres    false    285    268            �          0    33724    act_con 
   TABLE DATA               3   COPY public.act_con (cod_con, ide_ter) FROM stdin;
    public       postgres    false    196   ;�      �          0    33727    act_cul 
   TABLE DATA               3   COPY public.act_cul (cod_cul, ide_ter) FROM stdin;
    public       postgres    false    197   ��      D          0    36172    afeccion 
   TABLE DATA               �   COPY public.afeccion (cod_afe, nom_afe, noc_afe, inc_afe, sin_afe, par_afe, epo_afe, tcv_afe, prv_afe, aet_afe, hat_afe) FROM stdin;
    public       postgres    false    278   �      A          0    36137 	   agr_x_eag 
   TABLE DATA               5   COPY public.agr_x_eag (cod_eag, cod_agr) FROM stdin;
    public       postgres    false    275   ��      C          0    36157 	   agr_x_mol 
   TABLE DATA               >   COPY public.agr_x_mol (cod_agr, cod_mol, cac_agr) FROM stdin;
    public       postgres    false    277   �      ?          0    36112    agroquimicos 
   TABLE DATA               �   COPY public.agroquimicos (cod_agr, cod_ins, det_agr, rec_agr, pcr_agr, pen_agr, pro_agr, for_agr, cod_tag, cod_tox, est_agr) FROM stdin;
    public       postgres    false    273   7�      ;          0    35116    cliente 
   TABLE DATA               3   COPY public.cliente (ide_ter, cod_cli) FROM stdin;
    public       postgres    false    269   ��      �          0    33735    comprar 
   TABLE DATA               3   COPY public.comprar (cod_com, ide_ter) FROM stdin;
    public       postgres    false    198   ϭ      �          0    33738    compras 
   TABLE DATA               <   COPY public.compras (cod_com, fec_com, tot_com) FROM stdin;
    public       postgres    false    199   Z�      �          0    33743    comun 
   TABLE DATA               1   COPY public.comun (cod_cun, cod_tar) FROM stdin;
    public       postgres    false    201   �      �          0    33748 	   contratos 
   TABLE DATA               P   COPY public.contratos (cod_cot, val_cot, des_cot, cod_con, ffi_con) FROM stdin;
    public       postgres    false    203   �      �          0    33753    convenio 
   TABLE DATA               4   COPY public.convenio (cod_con, fec_con) FROM stdin;
    public       postgres    false    205   ��      �          0    33758    cultivos 
   TABLE DATA               �   COPY public.cultivos (cod_cul, fin_cul, fif_cul, npl_cul, tip_cul, dur_cul, est_cul, cod_ncu, cod_lot, dia_cul, mod_cul) FROM stdin;
    public       postgres    false    207   ޯ      �          0    33763    cultural 
   TABLE DATA               4   COPY public.cultural (cod_cut, cod_tar) FROM stdin;
    public       postgres    false    209   [�                0    33768    departamento 
   TABLE DATA               8   COPY public.departamento (cod_dep, nom_dep) FROM stdin;
    public       postgres    false    211   ~�                0    33771    desarrollar 
   TABLE DATA               7   COPY public.desarrollar (cod_tar, cod_lab) FROM stdin;
    public       postgres    false    212   ʱ                0    33774    dueño 
   TABLE DATA               4   COPY public."dueño" (cod_due, ide_ter) FROM stdin;
    public       postgres    false    213   �                0    33779    efectuar 
   TABLE DATA               4   COPY public.efectuar (cod_con, cod_tar) FROM stdin;
    public       postgres    false    215   &�                0    33782    ejecutar 
   TABLE DATA               4   COPY public.ejecutar (cod_con, cod_cul) FROM stdin;
    public       postgres    false    216   c�                0    33785    email_tercero 
   TABLE DATA               9   COPY public.email_tercero (ide_ter, ema_ter) FROM stdin;
    public       postgres    false    217   ��      E          0    36180    enfermedades 
   TABLE DATA               A   COPY public.enfermedades (cod_afe, cod_enf, pat_enf) FROM stdin;
    public       postgres    false    279   h�      @          0    36132    estado_agroquimico 
   TABLE DATA               >   COPY public.estado_agroquimico (cod_eag, det_eag) FROM stdin;
    public       postgres    false    274   ��      H          0    36205 	   eta_x_afe 
   TABLE DATA               5   COPY public.eta_x_afe (cod_afe, cod_eta) FROM stdin;
    public       postgres    false    282   ��      G          0    36200    etapas_crecimiento 
   TABLE DATA               G   COPY public.etapas_crecimiento (cod_eta, det_eta, ima_eta) FROM stdin;
    public       postgres    false    281   ��                0    33788    fincas 
   TABLE DATA               z   COPY public.fincas (cod_fin, nom_fin, det_fin, cod_dep, cod_mun, ide_ter, cod_unm, med_fin, cnt_fin, fot_fin) FROM stdin;
    public       postgres    false    218   ܳ      
          0    33796    fitosanitaria 
   TABLE DATA               B   COPY public.fitosanitaria (cod_fit, enf_fit, cod_tar) FROM stdin;
    public       postgres    false    220   ��                0    33801    gozar 
   TABLE DATA               U   COPY public.gozar (cod_tpr, cod_pro, fec_goz, ctp_goz, pre_goz, cpt_goz) FROM stdin;
    public       postgres    false    222   �                0    33804    insumos 
   TABLE DATA               <   COPY public.insumos (cod_ins, des_ins, cod_unm) FROM stdin;
    public       postgres    false    223   ��                0    33809    jornales 
   TABLE DATA               F   COPY public.jornales (cod_jor, hor_jor, vho_jor, cod_con) FROM stdin;
    public       postgres    false    225   ��                0    33814    labores 
   TABLE DATA               <   COPY public.labores (cod_lab, nom_lab, det_lab) FROM stdin;
    public       postgres    false    227   ׶                0    33819    lotes 
   TABLE DATA               L   COPY public.lotes (cod_lot, nom_lot, cod_fin, cod_unm, med_lot) FROM stdin;
    public       postgres    false    229   �      I          0    36220 	   mol_x_afe 
   TABLE DATA               >   COPY public.mol_x_afe (cod_mol, cod_afe, cod_eta) FROM stdin;
    public       postgres    false    283   շ      B          0    36152 	   moleculas 
   TABLE DATA               >   COPY public.moleculas (cod_mol, des_mol, pro_mol) FROM stdin;
    public       postgres    false    276   �                0    33824 	   municipio 
   TABLE DATA               >   COPY public.municipio (cod_mun, nom_mun, cod_dep) FROM stdin;
    public       postgres    false    231   �                0    33827    nombre_cultivo 
   TABLE DATA               :   COPY public.nombre_cultivo (cod_ncu, des_ncu) FROM stdin;
    public       postgres    false    232   x�                0    33832    otros 
   TABLE DATA               :   COPY public.otros (cod_otr, cod_ins, det_otr) FROM stdin;
    public       postgres    false    234   ��      F          0    36190    plagas 
   TABLE DATA               ;   COPY public.plagas (cod_afe, cod_plg, tip_plg) FROM stdin;
    public       postgres    false    280   |�      J          0    36240    planificacion 
   TABLE DATA               B   COPY public.planificacion (cod_pla, fec_pla, epo_pla) FROM stdin;
    public       postgres    false    284   ��                0    33837    pre_sto 
   TABLE DATA               E   COPY public.pre_sto (fec_cin, cod_sto, pre_sto, cod_pre) FROM stdin;
    public       postgres    false    236   ��                0    33840 
   produccion 
   TABLE DATA               ?   COPY public.produccion (cod_pro, cod_cul, ide_ter) FROM stdin;
    public       postgres    false    237   L�                0    33845 	   proveedor 
   TABLE DATA               5   COPY public.proveedor (cod_pro, ide_ter) FROM stdin;
    public       postgres    false    239   ��                0    33850 	   registrar 
   TABLE DATA               5   COPY public.registrar (cod_com, cod_sto) FROM stdin;
    public       postgres    false    241   ��                 0    33853    semillas 
   TABLE DATA               F   COPY public.semillas (cod_sem, cod_ins, cod_tsa, det_sem) FROM stdin;
    public       postgres    false    242   �      "          0    33858 	   semillero 
   TABLE DATA               G   COPY public.semillero (cod_smr, cod_ins, cod_tso, det_smr) FROM stdin;
    public       postgres    false    244   ��      $          0    33863    socio 
   TABLE DATA               1   COPY public.socio (cod_soc, ide_ter) FROM stdin;
    public       postgres    false    246   #�      &          0    33868    stock 
   TABLE DATA               :   COPY public.stock (cod_sto, can_sto, cod_ins) FROM stdin;
    public       postgres    false    248   P�      (          0    33873    tarea 
   TABLE DATA               L   COPY public.tarea (cod_tar, fin_tar, ffi_tar, val_tar, des_tar) FROM stdin;
    public       postgres    false    250   ��      *          0    33878    tel_tercero 
   TABLE DATA               7   COPY public.tel_tercero (ide_ter, tel_ter) FROM stdin;
    public       postgres    false    252   �      +          0    33881    terceros 
   TABLE DATA               O   COPY public.terceros (ide_ter, pno_ter, sno_ter, pap_ter, sap_ter) FROM stdin;
    public       postgres    false    253   ��      >          0    36107    tipo_agroquimico 
   TABLE DATA               <   COPY public.tipo_agroquimico (cod_tag, det_tag) FROM stdin;
    public       postgres    false    272   ��      ,          0    33884    tipo_de_produccion 
   TABLE DATA               G   COPY public.tipo_de_produccion (cod_tpr, des_tpr, cod_unm) FROM stdin;
    public       postgres    false    254   ��      .          0    33889    tipo_semilla 
   TABLE DATA               8   COPY public.tipo_semilla (cod_tsa, det_tsa) FROM stdin;
    public       postgres    false    256   F�      0          0    33894    tipo_semillero 
   TABLE DATA               :   COPY public.tipo_semillero (cod_tso, det_tso) FROM stdin;
    public       postgres    false    258   �      2          0    33899    tipo_unidad_medida 
   TABLE DATA               >   COPY public.tipo_unidad_medida (cod_tum, des_tum) FROM stdin;
    public       postgres    false    260   ��      =          0    36102 	   toxicidad 
   TABLE DATA               >   COPY public.toxicidad (cod_tox, det_tox, col_tox) FROM stdin;
    public       postgres    false    271   ��      4          0    33904 
   trabajador 
   TABLE DATA               6   COPY public.trabajador (cod_tra, ide_ter) FROM stdin;
    public       postgres    false    262   M�      6          0    33909    unidad_de_medida 
   TABLE DATA               N   COPY public.unidad_de_medida (cod_unm, des_unm, cod_tum, equ_med) FROM stdin;
    public       postgres    false    264   x�      8          0    33914    usuario 
   TABLE DATA               ;   COPY public.usuario (id_usu, usu_usu, pas_usu) FROM stdin;
    public       postgres    false    266   G�      :          0    33919    utilizar 
   TABLE DATA               O   COPY public.utilizar (cod_sto, cod_tar, cin_tar, pin_tar, cod_uti) FROM stdin;
    public       postgres    false    268   ��      s           0    0    cliente_cod_cli_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.cliente_cod_cli_seq', 9, true);
            public       postgres    false    270            t           0    0    compras_cod_com_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.compras_cod_com_seq', 1, false);
            public       postgres    false    200            u           0    0    comun_cod_cun_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.comun_cod_cun_seq', 42, true);
            public       postgres    false    202            v           0    0    contratos_cod_cot_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.contratos_cod_cot_seq', 39, true);
            public       postgres    false    204            w           0    0    convenio_cod_con_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.convenio_cod_con_seq', 114, true);
            public       postgres    false    206            x           0    0    cultivos_cod_cul_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.cultivos_cod_cul_seq', 68, true);
            public       postgres    false    208            y           0    0    cultural_cod_cut_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.cultural_cod_cut_seq', 18, true);
            public       postgres    false    210            z           0    0    dueño_cod_due_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public."dueño_cod_due_seq"', 42, true);
            public       postgres    false    214            {           0    0    fincas_cnt_fin_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.fincas_cnt_fin_seq', 51, true);
            public       postgres    false    219            |           0    0    fitosanitaria_cod_fit_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.fitosanitaria_cod_fit_seq', 12, true);
            public       postgres    false    221            }           0    0    insumos_cod_ins_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.insumos_cod_ins_seq', 72, true);
            public       postgres    false    224            ~           0    0    jornales_cod_jor_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.jornales_cod_jor_seq', 63, true);
            public       postgres    false    226                       0    0    labores_cod_lab_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.labores_cod_lab_seq', 19, true);
            public       postgres    false    228            �           0    0    lotes_cod_lot_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.lotes_cod_lot_seq', 82, true);
            public       postgres    false    230            �           0    0    nombre_cultivo_cod_ncu_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.nombre_cultivo_cod_ncu_seq', 33, true);
            public       postgres    false    233            �           0    0    otros_cod_otr_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.otros_cod_otr_seq', 17, true);
            public       postgres    false    235            �           0    0    pre_sto_cod_pre_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.pre_sto_cod_pre_seq', 96, true);
            public       postgres    false    286            �           0    0    produccion_cod_pro_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.produccion_cod_pro_seq', 73, true);
            public       postgres    false    238            �           0    0    proveedor_cod_pro_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.proveedor_cod_pro_seq', 16, true);
            public       postgres    false    240            �           0    0    semillas_cod_sem_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.semillas_cod_sem_seq', 20, true);
            public       postgres    false    243            �           0    0    semillero_cod_smr_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.semillero_cod_smr_seq', 12, true);
            public       postgres    false    245            �           0    0    socio_cod_soc_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.socio_cod_soc_seq', 17, true);
            public       postgres    false    247            �           0    0    stock_cod_sto_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.stock_cod_sto_seq', 299, true);
            public       postgres    false    249            �           0    0    tarea_cod_tar_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tarea_cod_tar_seq', 79, true);
            public       postgres    false    251            �           0    0    tipo_de_produccion_cod_tpr_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tipo_de_produccion_cod_tpr_seq', 6, true);
            public       postgres    false    255            �           0    0    tipo_semilla_cod_tsa_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tipo_semilla_cod_tsa_seq', 1, true);
            public       postgres    false    257            �           0    0    tipo_semillero_cod_tso_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tipo_semillero_cod_tso_seq', 2, true);
            public       postgres    false    259            �           0    0    tipo_unidad_medida_cod_tum_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tipo_unidad_medida_cod_tum_seq', 1, false);
            public       postgres    false    261            �           0    0    trabajador_cod_tra_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.trabajador_cod_tra_seq', 26, true);
            public       postgres    false    263            �           0    0    unidad_de_medida_cod_unm_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.unidad_de_medida_cod_unm_seq', 7, true);
            public       postgres    false    265            �           0    0    usuario_id_usu_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.usuario_id_usu_seq', 2, true);
            public       postgres    false    267            �           0    0    utilizar_cod_uti_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.utilizar_cod_uti_seq', 70, true);
            public       postgres    false    285            �           2606    34610    act_con acordar_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.act_con
    ADD CONSTRAINT acordar_pkey PRIMARY KEY (cod_con, ide_ter);
 >   ALTER TABLE ONLY public.act_con DROP CONSTRAINT acordar_pkey;
       public         postgres    false    196    196            �           2606    34617    act_cul actuar_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.act_cul
    ADD CONSTRAINT actuar_pkey PRIMARY KEY (ide_ter, cod_cul);
 =   ALTER TABLE ONLY public.act_cul DROP CONSTRAINT actuar_pkey;
       public         postgres    false    197    197            +           2606    36179    afeccion afeccion_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.afeccion
    ADD CONSTRAINT afeccion_pkey PRIMARY KEY (cod_afe);
 @   ALTER TABLE ONLY public.afeccion DROP CONSTRAINT afeccion_pkey;
       public         postgres    false    278            %           2606    36141    agr_x_eag agr_x_eag_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.agr_x_eag
    ADD CONSTRAINT agr_x_eag_pkey PRIMARY KEY (cod_eag, cod_agr);
 B   ALTER TABLE ONLY public.agr_x_eag DROP CONSTRAINT agr_x_eag_pkey;
       public         postgres    false    275    275            )           2606    36161    agr_x_mol agr_x_mol_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.agr_x_mol
    ADD CONSTRAINT agr_x_mol_pkey PRIMARY KEY (cod_agr, cod_mol);
 B   ALTER TABLE ONLY public.agr_x_mol DROP CONSTRAINT agr_x_mol_pkey;
       public         postgres    false    277    277            !           2606    36116    agroquimicos agroquimicos_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT agroquimicos_pkey PRIMARY KEY (cod_agr);
 H   ALTER TABLE ONLY public.agroquimicos DROP CONSTRAINT agroquimicos_pkey;
       public         postgres    false    273                       2606    35133    cliente cliente_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (cod_cli);
 >   ALTER TABLE ONLY public.cliente DROP CONSTRAINT cliente_pkey;
       public         postgres    false    269            �           2606    34624    comprar comprar_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.comprar
    ADD CONSTRAINT comprar_pkey PRIMARY KEY (ide_ter, cod_com);
 >   ALTER TABLE ONLY public.comprar DROP CONSTRAINT comprar_pkey;
       public         postgres    false    198    198            �           2606    33961    compras compras_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.compras
    ADD CONSTRAINT compras_pkey PRIMARY KEY (cod_com);
 >   ALTER TABLE ONLY public.compras DROP CONSTRAINT compras_pkey;
       public         postgres    false    199            �           2606    33963    comun comun_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.comun
    ADD CONSTRAINT comun_pkey PRIMARY KEY (cod_cun);
 :   ALTER TABLE ONLY public.comun DROP CONSTRAINT comun_pkey;
       public         postgres    false    201            �           2606    33965    contratos contratos_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.contratos
    ADD CONSTRAINT contratos_pkey PRIMARY KEY (cod_cot);
 B   ALTER TABLE ONLY public.contratos DROP CONSTRAINT contratos_pkey;
       public         postgres    false    203            �           2606    33967    convenio convenio_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.convenio
    ADD CONSTRAINT convenio_pkey PRIMARY KEY (cod_con);
 @   ALTER TABLE ONLY public.convenio DROP CONSTRAINT convenio_pkey;
       public         postgres    false    205            �           2606    33969    cultivos cultivos_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.cultivos
    ADD CONSTRAINT cultivos_pkey PRIMARY KEY (cod_cul);
 @   ALTER TABLE ONLY public.cultivos DROP CONSTRAINT cultivos_pkey;
       public         postgres    false    207            �           2606    33971    cultural cultural_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.cultural
    ADD CONSTRAINT cultural_pkey PRIMARY KEY (cod_cut);
 @   ALTER TABLE ONLY public.cultural DROP CONSTRAINT cultural_pkey;
       public         postgres    false    209            �           2606    33973    departamento departamento_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (cod_dep);
 H   ALTER TABLE ONLY public.departamento DROP CONSTRAINT departamento_pkey;
       public         postgres    false    211            �           2606    33975    dueño dueño_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public."dueño"
    ADD CONSTRAINT "dueño_pkey" PRIMARY KEY (cod_due);
 @   ALTER TABLE ONLY public."dueño" DROP CONSTRAINT "dueño_pkey";
       public         postgres    false    213            �           2606    33977    ejecutar ejecutar_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.ejecutar
    ADD CONSTRAINT ejecutar_pkey PRIMARY KEY (cod_con, cod_cul);
 @   ALTER TABLE ONLY public.ejecutar DROP CONSTRAINT ejecutar_pkey;
       public         postgres    false    216    216            �           2606    34636     email_tercero email_tercero_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.email_tercero
    ADD CONSTRAINT email_tercero_pkey PRIMARY KEY (ide_ter, ema_ter);
 J   ALTER TABLE ONLY public.email_tercero DROP CONSTRAINT email_tercero_pkey;
       public         postgres    false    217    217            -           2606    36184    enfermedades enfermedades_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.enfermedades
    ADD CONSTRAINT enfermedades_pkey PRIMARY KEY (cod_afe, cod_enf);
 H   ALTER TABLE ONLY public.enfermedades DROP CONSTRAINT enfermedades_pkey;
       public         postgres    false    279    279            #           2606    36136 *   estado_agroquimico estado_agroquimico_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.estado_agroquimico
    ADD CONSTRAINT estado_agroquimico_pkey PRIMARY KEY (cod_eag);
 T   ALTER TABLE ONLY public.estado_agroquimico DROP CONSTRAINT estado_agroquimico_pkey;
       public         postgres    false    274            3           2606    36209    eta_x_afe eta_x_afe_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.eta_x_afe
    ADD CONSTRAINT eta_x_afe_pkey PRIMARY KEY (cod_afe, cod_eta);
 B   ALTER TABLE ONLY public.eta_x_afe DROP CONSTRAINT eta_x_afe_pkey;
       public         postgres    false    282    282            1           2606    36204 *   etapas_crecimiento etapas_crecimiento_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.etapas_crecimiento
    ADD CONSTRAINT etapas_crecimiento_pkey PRIMARY KEY (cod_eta);
 T   ALTER TABLE ONLY public.etapas_crecimiento DROP CONSTRAINT etapas_crecimiento_pkey;
       public         postgres    false    281            �           2606    33981    fincas fincas_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_pkey PRIMARY KEY (cod_fin);
 <   ALTER TABLE ONLY public.fincas DROP CONSTRAINT fincas_pkey;
       public         postgres    false    218            �           2606    33983     fitosanitaria fitosanitaria_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.fitosanitaria
    ADD CONSTRAINT fitosanitaria_pkey PRIMARY KEY (cod_fit);
 J   ALTER TABLE ONLY public.fitosanitaria DROP CONSTRAINT fitosanitaria_pkey;
       public         postgres    false    220            �           2606    33985    gozar gozar_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.gozar
    ADD CONSTRAINT gozar_pkey PRIMARY KEY (cod_tpr, cod_pro);
 :   ALTER TABLE ONLY public.gozar DROP CONSTRAINT gozar_pkey;
       public         postgres    false    222    222            �           2606    33987    insumos insumos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.insumos
    ADD CONSTRAINT insumos_pkey PRIMARY KEY (cod_ins);
 >   ALTER TABLE ONLY public.insumos DROP CONSTRAINT insumos_pkey;
       public         postgres    false    223            �           2606    33989    jornales jornales_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.jornales
    ADD CONSTRAINT jornales_pkey PRIMARY KEY (cod_jor);
 @   ALTER TABLE ONLY public.jornales DROP CONSTRAINT jornales_pkey;
       public         postgres    false    225            �           2606    33991    labores labores_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.labores
    ADD CONSTRAINT labores_pkey PRIMARY KEY (cod_lab);
 >   ALTER TABLE ONLY public.labores DROP CONSTRAINT labores_pkey;
       public         postgres    false    227            �           2606    33993    lotes lotes_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_pkey PRIMARY KEY (cod_lot);
 :   ALTER TABLE ONLY public.lotes DROP CONSTRAINT lotes_pkey;
       public         postgres    false    229            5           2606    36224    mol_x_afe mol_x_afe_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT mol_x_afe_pkey PRIMARY KEY (cod_mol, cod_afe, cod_eta);
 B   ALTER TABLE ONLY public.mol_x_afe DROP CONSTRAINT mol_x_afe_pkey;
       public         postgres    false    283    283    283            '           2606    36156    moleculas moleculas_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.moleculas
    ADD CONSTRAINT moleculas_pkey PRIMARY KEY (cod_mol);
 B   ALTER TABLE ONLY public.moleculas DROP CONSTRAINT moleculas_pkey;
       public         postgres    false    276            �           2606    33995    municipio municipio_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (cod_mun);
 B   ALTER TABLE ONLY public.municipio DROP CONSTRAINT municipio_pkey;
       public         postgres    false    231            �           2606    33997 "   nombre_cultivo nombre_cultivo_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.nombre_cultivo
    ADD CONSTRAINT nombre_cultivo_pkey PRIMARY KEY (cod_ncu);
 L   ALTER TABLE ONLY public.nombre_cultivo DROP CONSTRAINT nombre_cultivo_pkey;
       public         postgres    false    232            �           2606    33999    otros otros_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.otros
    ADD CONSTRAINT otros_pkey PRIMARY KEY (cod_otr);
 :   ALTER TABLE ONLY public.otros DROP CONSTRAINT otros_pkey;
       public         postgres    false    234            /           2606    36194    plagas plagas_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.plagas
    ADD CONSTRAINT plagas_pkey PRIMARY KEY (cod_afe, cod_plg);
 <   ALTER TABLE ONLY public.plagas DROP CONSTRAINT plagas_pkey;
       public         postgres    false    280    280            7           2606    36244     planificacion planificacion_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.planificacion
    ADD CONSTRAINT planificacion_pkey PRIMARY KEY (cod_pla);
 J   ALTER TABLE ONLY public.planificacion DROP CONSTRAINT planificacion_pkey;
       public         postgres    false    284            �           2606    44477    pre_sto pre_sto_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.pre_sto
    ADD CONSTRAINT pre_sto_pkey PRIMARY KEY (fec_cin, cod_sto, cod_pre);
 >   ALTER TABLE ONLY public.pre_sto DROP CONSTRAINT pre_sto_pkey;
       public         postgres    false    236    236    236            �           2606    34003    produccion produccion_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.produccion
    ADD CONSTRAINT produccion_pkey PRIMARY KEY (cod_pro);
 D   ALTER TABLE ONLY public.produccion DROP CONSTRAINT produccion_pkey;
       public         postgres    false    237            �           2606    34005    proveedor proveedor_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (cod_pro);
 B   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT proveedor_pkey;
       public         postgres    false    239            �           2606    34007    registrar registar_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.registrar
    ADD CONSTRAINT registar_pkey PRIMARY KEY (cod_com, cod_sto);
 A   ALTER TABLE ONLY public.registrar DROP CONSTRAINT registar_pkey;
       public         postgres    false    241    241            �           2606    34009    semillas semillas_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.semillas
    ADD CONSTRAINT semillas_pkey PRIMARY KEY (cod_sem);
 @   ALTER TABLE ONLY public.semillas DROP CONSTRAINT semillas_pkey;
       public         postgres    false    242            �           2606    34011    semillero semillero_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.semillero
    ADD CONSTRAINT semillero_pkey PRIMARY KEY (cod_smr);
 B   ALTER TABLE ONLY public.semillero DROP CONSTRAINT semillero_pkey;
       public         postgres    false    244                       2606    34013    socio socio_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.socio
    ADD CONSTRAINT socio_pkey PRIMARY KEY (cod_soc);
 :   ALTER TABLE ONLY public.socio DROP CONSTRAINT socio_pkey;
       public         postgres    false    246                       2606    34015    stock stock_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.stock
    ADD CONSTRAINT stock_pkey PRIMARY KEY (cod_sto);
 :   ALTER TABLE ONLY public.stock DROP CONSTRAINT stock_pkey;
       public         postgres    false    248                       2606    34017    tarea tarea_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.tarea
    ADD CONSTRAINT tarea_pkey PRIMARY KEY (cod_tar);
 :   ALTER TABLE ONLY public.tarea DROP CONSTRAINT tarea_pkey;
       public         postgres    false    250                       2606    34658    tel_tercero tel_tercero_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tel_tercero
    ADD CONSTRAINT tel_tercero_pkey PRIMARY KEY (ide_ter, tel_ter);
 F   ALTER TABLE ONLY public.tel_tercero DROP CONSTRAINT tel_tercero_pkey;
       public         postgres    false    252    252            	           2606    34665    terceros terceros_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.terceros
    ADD CONSTRAINT terceros_pkey PRIMARY KEY (ide_ter);
 @   ALTER TABLE ONLY public.terceros DROP CONSTRAINT terceros_pkey;
       public         postgres    false    253                       2606    36111 &   tipo_agroquimico tipo_agroquimico_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.tipo_agroquimico
    ADD CONSTRAINT tipo_agroquimico_pkey PRIMARY KEY (cod_tag);
 P   ALTER TABLE ONLY public.tipo_agroquimico DROP CONSTRAINT tipo_agroquimico_pkey;
       public         postgres    false    272                       2606    34023 *   tipo_de_produccion tipo_de_produccion_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.tipo_de_produccion
    ADD CONSTRAINT tipo_de_produccion_pkey PRIMARY KEY (cod_tpr);
 T   ALTER TABLE ONLY public.tipo_de_produccion DROP CONSTRAINT tipo_de_produccion_pkey;
       public         postgres    false    254                       2606    34025    tipo_semilla tipo_semilla_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.tipo_semilla
    ADD CONSTRAINT tipo_semilla_pkey PRIMARY KEY (cod_tsa);
 H   ALTER TABLE ONLY public.tipo_semilla DROP CONSTRAINT tipo_semilla_pkey;
       public         postgres    false    256                       2606    34027 "   tipo_semillero tipo_semillero_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tipo_semillero
    ADD CONSTRAINT tipo_semillero_pkey PRIMARY KEY (cod_tso);
 L   ALTER TABLE ONLY public.tipo_semillero DROP CONSTRAINT tipo_semillero_pkey;
       public         postgres    false    258                       2606    34029 *   tipo_unidad_medida tipo_unidad_medida_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.tipo_unidad_medida
    ADD CONSTRAINT tipo_unidad_medida_pkey PRIMARY KEY (cod_tum);
 T   ALTER TABLE ONLY public.tipo_unidad_medida DROP CONSTRAINT tipo_unidad_medida_pkey;
       public         postgres    false    260                       2606    36106    toxicidad toxicidad_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.toxicidad
    ADD CONSTRAINT toxicidad_pkey PRIMARY KEY (cod_tox);
 B   ALTER TABLE ONLY public.toxicidad DROP CONSTRAINT toxicidad_pkey;
       public         postgres    false    271                       2606    34031    trabajador trabajador_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.trabajador
    ADD CONSTRAINT trabajador_pkey PRIMARY KEY (cod_tra);
 D   ALTER TABLE ONLY public.trabajador DROP CONSTRAINT trabajador_pkey;
       public         postgres    false    262                       2606    34033 &   unidad_de_medida unidad_de_medida_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.unidad_de_medida
    ADD CONSTRAINT unidad_de_medida_pkey PRIMARY KEY (cod_unm);
 P   ALTER TABLE ONLY public.unidad_de_medida DROP CONSTRAINT unidad_de_medida_pkey;
       public         postgres    false    264                       2606    34035    usuario usuario_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usu);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public         postgres    false    266                       2606    44468    utilizar utilizar_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.utilizar
    ADD CONSTRAINT utilizar_pkey PRIMARY KEY (cod_sto, cod_tar, cod_uti);
 @   ALTER TABLE ONLY public.utilizar DROP CONSTRAINT utilizar_pkey;
       public         postgres    false    268    268    268            8           2606    34038    act_con acordar_cod_con_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.act_con
    ADD CONSTRAINT acordar_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);
 F   ALTER TABLE ONLY public.act_con DROP CONSTRAINT acordar_cod_con_fkey;
       public       postgres    false    205    196    3027            9           2606    34706    act_con acordar_ide_ter_gkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.act_con
    ADD CONSTRAINT acordar_ide_ter_gkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 F   ALTER TABLE ONLY public.act_con DROP CONSTRAINT acordar_ide_ter_gkey;
       public       postgres    false    196    3081    253            :           2606    34048    act_cul actuar_cod_cul_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.act_cul
    ADD CONSTRAINT actuar_cod_cul_fkey FOREIGN KEY (cod_cul) REFERENCES public.cultivos(cod_cul);
 E   ALTER TABLE ONLY public.act_cul DROP CONSTRAINT actuar_cod_cul_fkey;
       public       postgres    false    3029    207    197            ;           2606    34701    act_cul actuar_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.act_cul
    ADD CONSTRAINT actuar_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 E   ALTER TABLE ONLY public.act_cul DROP CONSTRAINT actuar_ide_ter_fkey;
       public       postgres    false    3081    253    197            m           2606    36127 &   agroquimicos agroquimicos_cod_ins_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT agroquimicos_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);
 P   ALTER TABLE ONLY public.agroquimicos DROP CONSTRAINT agroquimicos_cod_ins_fkey;
       public       postgres    false    223    3047    273            j           2606    35121    cliente cliente_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 F   ALTER TABLE ONLY public.cliente DROP CONSTRAINT cliente_ide_ter_fkey;
       public       postgres    false    253    3081    269            <           2606    34063    comprar comprar_cod_com_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.comprar
    ADD CONSTRAINT comprar_cod_com_fkey FOREIGN KEY (cod_com) REFERENCES public.compras(cod_com);
 F   ALTER TABLE ONLY public.comprar DROP CONSTRAINT comprar_cod_com_fkey;
       public       postgres    false    198    199    3021            =           2606    34696    comprar comprar_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.comprar
    ADD CONSTRAINT comprar_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 F   ALTER TABLE ONLY public.comprar DROP CONSTRAINT comprar_ide_ter_fkey;
       public       postgres    false    3081    198    253            >           2606    34073    comun comun_cod_tar_fkey    FK CONSTRAINT     |   ALTER TABLE ONLY public.comun
    ADD CONSTRAINT comun_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);
 B   ALTER TABLE ONLY public.comun DROP CONSTRAINT comun_cod_tar_fkey;
       public       postgres    false    201    3077    250            ?           2606    34078     contratos contratos_cod_con_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.contratos
    ADD CONSTRAINT contratos_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);
 J   ALTER TABLE ONLY public.contratos DROP CONSTRAINT contratos_cod_con_fkey;
       public       postgres    false    203    3027    205            F           2606    34083    efectuar convenio_cod_con_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.efectuar
    ADD CONSTRAINT convenio_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);
 H   ALTER TABLE ONLY public.efectuar DROP CONSTRAINT convenio_cod_con_fkey;
       public       postgres    false    3027    215    205            @           2606    34088    cultivos cultivos_cod_lot_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cultivos
    ADD CONSTRAINT cultivos_cod_lot_fkey FOREIGN KEY (cod_lot) REFERENCES public.lotes(cod_lot);
 H   ALTER TABLE ONLY public.cultivos DROP CONSTRAINT cultivos_cod_lot_fkey;
       public       postgres    false    229    207    3053            A           2606    34093    cultivos cultivos_cod_ncu_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cultivos
    ADD CONSTRAINT cultivos_cod_ncu_fkey FOREIGN KEY (cod_ncu) REFERENCES public.nombre_cultivo(cod_ncu);
 H   ALTER TABLE ONLY public.cultivos DROP CONSTRAINT cultivos_cod_ncu_fkey;
       public       postgres    false    3057    232    207            B           2606    34098    cultural cultural_cod_tar_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cultural
    ADD CONSTRAINT cultural_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);
 H   ALTER TABLE ONLY public.cultural DROP CONSTRAINT cultural_cod_tar_fkey;
       public       postgres    false    3077    209    250            E           2606    34691    dueño dueño_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."dueño"
    ADD CONSTRAINT "dueño_ide_ter_fkey" FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 H   ALTER TABLE ONLY public."dueño" DROP CONSTRAINT "dueño_ide_ter_fkey";
       public       postgres    false    3081    253    213            H           2606    34108    ejecutar ejecutar_cod_con_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.ejecutar
    ADD CONSTRAINT ejecutar_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);
 H   ALTER TABLE ONLY public.ejecutar DROP CONSTRAINT ejecutar_cod_con_fkey;
       public       postgres    false    205    3027    216            I           2606    34113    ejecutar ejecutar_cod_cul_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.ejecutar
    ADD CONSTRAINT ejecutar_cod_cul_fkey FOREIGN KEY (cod_cul) REFERENCES public.cultivos(cod_cul);
 H   ALTER TABLE ONLY public.ejecutar DROP CONSTRAINT ejecutar_cod_cul_fkey;
       public       postgres    false    216    207    3029            J           2606    34686 (   email_tercero email_tercero_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.email_tercero
    ADD CONSTRAINT email_tercero_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 R   ALTER TABLE ONLY public.email_tercero DROP CONSTRAINT email_tercero_ide_ter_fkey;
       public       postgres    false    3081    217    253            K           2606    34123    fincas fincas_cod_dep_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_cod_dep_fkey FOREIGN KEY (cod_dep) REFERENCES public.departamento(cod_dep);
 D   ALTER TABLE ONLY public.fincas DROP CONSTRAINT fincas_cod_dep_fkey;
       public       postgres    false    218    3033    211            L           2606    34128    fincas fincas_cod_mun_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_cod_mun_fkey FOREIGN KEY (cod_mun) REFERENCES public.municipio(cod_mun);
 D   ALTER TABLE ONLY public.fincas DROP CONSTRAINT fincas_cod_mun_fkey;
       public       postgres    false    218    3055    231            M           2606    34133    fincas fincas_cod_unm_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);
 D   ALTER TABLE ONLY public.fincas DROP CONSTRAINT fincas_cod_unm_fkey;
       public       postgres    false    3093    264    218            N           2606    34681    fincas fincas_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 D   ALTER TABLE ONLY public.fincas DROP CONSTRAINT fincas_ide_ter_fkey;
       public       postgres    false    3081    253    218            O           2606    34143 (   fitosanitaria fitosanitaria_cod_tar_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.fitosanitaria
    ADD CONSTRAINT fitosanitaria_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);
 R   ALTER TABLE ONLY public.fitosanitaria DROP CONSTRAINT fitosanitaria_cod_tar_fkey;
       public       postgres    false    250    3077    220            t           2606    36210    eta_x_afe fk_afe_x_eta_x_afe    FK CONSTRAINT     �   ALTER TABLE ONLY public.eta_x_afe
    ADD CONSTRAINT fk_afe_x_eta_x_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);
 F   ALTER TABLE ONLY public.eta_x_afe DROP CONSTRAINT fk_afe_x_eta_x_afe;
       public       postgres    false    278    282    3115            w           2606    36230    mol_x_afe fk_afe_x_mol_x_afe    FK CONSTRAINT     �   ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT fk_afe_x_mol_x_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);
 F   ALTER TABLE ONLY public.mol_x_afe DROP CONSTRAINT fk_afe_x_mol_x_afe;
       public       postgres    false    278    283    3115            p           2606    36162    agr_x_mol fk_agr_x_agr_mol    FK CONSTRAINT     �   ALTER TABLE ONLY public.agr_x_mol
    ADD CONSTRAINT fk_agr_x_agr_mol FOREIGN KEY (cod_agr) REFERENCES public.agroquimicos(cod_agr);
 D   ALTER TABLE ONLY public.agr_x_mol DROP CONSTRAINT fk_agr_x_agr_mol;
       public       postgres    false    273    3105    277            o           2606    36147    agr_x_eag fk_agr_x_agr_x_eag    FK CONSTRAINT     �   ALTER TABLE ONLY public.agr_x_eag
    ADD CONSTRAINT fk_agr_x_agr_x_eag FOREIGN KEY (cod_agr) REFERENCES public.agroquimicos(cod_agr);
 F   ALTER TABLE ONLY public.agr_x_eag DROP CONSTRAINT fk_agr_x_agr_x_eag;
       public       postgres    false    273    3105    275            n           2606    36142    agr_x_eag fk_eag_x_agr_x_eag    FK CONSTRAINT     �   ALTER TABLE ONLY public.agr_x_eag
    ADD CONSTRAINT fk_eag_x_agr_x_eag FOREIGN KEY (cod_eag) REFERENCES public.estado_agroquimico(cod_eag);
 F   ALTER TABLE ONLY public.agr_x_eag DROP CONSTRAINT fk_eag_x_agr_x_eag;
       public       postgres    false    275    274    3107            r           2606    36185    enfermedades fk_enf_x_afe    FK CONSTRAINT     �   ALTER TABLE ONLY public.enfermedades
    ADD CONSTRAINT fk_enf_x_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);
 C   ALTER TABLE ONLY public.enfermedades DROP CONSTRAINT fk_enf_x_afe;
       public       postgres    false    279    3115    278            u           2606    36215    eta_x_afe fk_eta_x_eta_x_afe    FK CONSTRAINT     �   ALTER TABLE ONLY public.eta_x_afe
    ADD CONSTRAINT fk_eta_x_eta_x_afe FOREIGN KEY (cod_eta) REFERENCES public.etapas_crecimiento(cod_eta);
 F   ALTER TABLE ONLY public.eta_x_afe DROP CONSTRAINT fk_eta_x_eta_x_afe;
       public       postgres    false    281    282    3121            x           2606    36235    mol_x_afe fk_eta_x_mol_x_afe    FK CONSTRAINT     �   ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT fk_eta_x_mol_x_afe FOREIGN KEY (cod_eta) REFERENCES public.etapas_crecimiento(cod_eta);
 F   ALTER TABLE ONLY public.mol_x_afe DROP CONSTRAINT fk_eta_x_mol_x_afe;
       public       postgres    false    3121    283    281            q           2606    36167    agr_x_mol fk_mol_x_agr_mol    FK CONSTRAINT     �   ALTER TABLE ONLY public.agr_x_mol
    ADD CONSTRAINT fk_mol_x_agr_mol FOREIGN KEY (cod_mol) REFERENCES public.moleculas(cod_mol);
 D   ALTER TABLE ONLY public.agr_x_mol DROP CONSTRAINT fk_mol_x_agr_mol;
       public       postgres    false    277    3111    276            v           2606    36225    mol_x_afe fk_mol_x_mol_x_afe    FK CONSTRAINT     �   ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT fk_mol_x_mol_x_afe FOREIGN KEY (cod_mol) REFERENCES public.moleculas(cod_mol);
 F   ALTER TABLE ONLY public.mol_x_afe DROP CONSTRAINT fk_mol_x_mol_x_afe;
       public       postgres    false    276    3111    283            s           2606    36195    plagas fk_plg_afe    FK CONSTRAINT     x   ALTER TABLE ONLY public.plagas
    ADD CONSTRAINT fk_plg_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);
 ;   ALTER TABLE ONLY public.plagas DROP CONSTRAINT fk_plg_afe;
       public       postgres    false    3115    278    280            k           2606    36117    agroquimicos fk_tag_x_agr    FK CONSTRAINT     �   ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT fk_tag_x_agr FOREIGN KEY (cod_tag) REFERENCES public.tipo_agroquimico(cod_tag);
 C   ALTER TABLE ONLY public.agroquimicos DROP CONSTRAINT fk_tag_x_agr;
       public       postgres    false    273    3103    272            l           2606    36122    agroquimicos fk_tox_x_agr    FK CONSTRAINT     �   ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT fk_tox_x_agr FOREIGN KEY (cod_tox) REFERENCES public.toxicidad(cod_tox);
 C   ALTER TABLE ONLY public.agroquimicos DROP CONSTRAINT fk_tox_x_agr;
       public       postgres    false    273    271    3101            P           2606    34148    gozar gozar_cod_pro_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.gozar
    ADD CONSTRAINT gozar_cod_pro_fkey FOREIGN KEY (cod_pro) REFERENCES public.produccion(cod_pro);
 B   ALTER TABLE ONLY public.gozar DROP CONSTRAINT gozar_cod_pro_fkey;
       public       postgres    false    237    222    3063            Q           2606    34153    gozar gozar_cod_tpr_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.gozar
    ADD CONSTRAINT gozar_cod_tpr_fkey FOREIGN KEY (cod_tpr) REFERENCES public.tipo_de_produccion(cod_tpr);
 B   ALTER TABLE ONLY public.gozar DROP CONSTRAINT gozar_cod_tpr_fkey;
       public       postgres    false    3083    222    254            R           2606    34158    insumos insumos_cod_unm_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.insumos
    ADD CONSTRAINT insumos_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);
 F   ALTER TABLE ONLY public.insumos DROP CONSTRAINT insumos_cod_unm_fkey;
       public       postgres    false    3093    223    264            S           2606    34163    jornales jornales_cod_con_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.jornales
    ADD CONSTRAINT jornales_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);
 H   ALTER TABLE ONLY public.jornales DROP CONSTRAINT jornales_cod_con_fkey;
       public       postgres    false    3027    225    205            C           2606    34168     desarrollar labores_cod_lab_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.desarrollar
    ADD CONSTRAINT labores_cod_lab_fkey FOREIGN KEY (cod_lab) REFERENCES public.labores(cod_lab);
 J   ALTER TABLE ONLY public.desarrollar DROP CONSTRAINT labores_cod_lab_fkey;
       public       postgres    false    212    227    3051            T           2606    34173    lotes lotes_cod_fin_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_cod_fin_fkey FOREIGN KEY (cod_fin) REFERENCES public.fincas(cod_fin);
 B   ALTER TABLE ONLY public.lotes DROP CONSTRAINT lotes_cod_fin_fkey;
       public       postgres    false    229    218    3041            U           2606    34178    lotes lotes_cod_unm_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);
 B   ALTER TABLE ONLY public.lotes DROP CONSTRAINT lotes_cod_unm_fkey;
       public       postgres    false    264    229    3093            V           2606    34183     municipio municipio_cod_dep_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT municipio_cod_dep_fkey FOREIGN KEY (cod_dep) REFERENCES public.departamento(cod_dep);
 J   ALTER TABLE ONLY public.municipio DROP CONSTRAINT municipio_cod_dep_fkey;
       public       postgres    false    3033    211    231            W           2606    34188    otros otros_cod_ins_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY public.otros
    ADD CONSTRAINT otros_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);
 B   ALTER TABLE ONLY public.otros DROP CONSTRAINT otros_cod_ins_fkey;
       public       postgres    false    234    3047    223            X           2606    34193    pre_sto pre_sto_cod_sto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pre_sto
    ADD CONSTRAINT pre_sto_cod_sto_fkey FOREIGN KEY (cod_sto) REFERENCES public.stock(cod_sto);
 F   ALTER TABLE ONLY public.pre_sto DROP CONSTRAINT pre_sto_cod_sto_fkey;
       public       postgres    false    3075    236    248            Y           2606    34198 "   produccion produccion_cod_cul_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.produccion
    ADD CONSTRAINT produccion_cod_cul_fkey FOREIGN KEY (cod_cul) REFERENCES public.cultivos(cod_cul);
 L   ALTER TABLE ONLY public.produccion DROP CONSTRAINT produccion_cod_cul_fkey;
       public       postgres    false    237    3029    207            Z           2606    44622 "   produccion produccion_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.produccion
    ADD CONSTRAINT produccion_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 L   ALTER TABLE ONLY public.produccion DROP CONSTRAINT produccion_ide_ter_fkey;
       public       postgres    false    253    3081    237            [           2606    34676     proveedor proveedor_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 J   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT proveedor_ide_ter_fkey;
       public       postgres    false    239    253    3081            \           2606    34208    registrar registar_cod_com_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrar
    ADD CONSTRAINT registar_cod_com_fkey FOREIGN KEY (cod_com) REFERENCES public.compras(cod_com);
 I   ALTER TABLE ONLY public.registrar DROP CONSTRAINT registar_cod_com_fkey;
       public       postgres    false    241    199    3021            ]           2606    34213    registrar registar_cod_sto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrar
    ADD CONSTRAINT registar_cod_sto_fkey FOREIGN KEY (cod_sto) REFERENCES public.stock(cod_sto);
 I   ALTER TABLE ONLY public.registrar DROP CONSTRAINT registar_cod_sto_fkey;
       public       postgres    false    241    3075    248            ^           2606    34218    semillas semillas_cod_ins_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.semillas
    ADD CONSTRAINT semillas_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);
 H   ALTER TABLE ONLY public.semillas DROP CONSTRAINT semillas_cod_ins_fkey;
       public       postgres    false    223    3047    242            _           2606    34223    semillas semillas_cod_tsa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.semillas
    ADD CONSTRAINT semillas_cod_tsa_fkey FOREIGN KEY (cod_tsa) REFERENCES public.tipo_semilla(cod_tsa);
 H   ALTER TABLE ONLY public.semillas DROP CONSTRAINT semillas_cod_tsa_fkey;
       public       postgres    false    242    3085    256            `           2606    34228     semillero semillero_cod_ins_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.semillero
    ADD CONSTRAINT semillero_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);
 J   ALTER TABLE ONLY public.semillero DROP CONSTRAINT semillero_cod_ins_fkey;
       public       postgres    false    244    3047    223            a           2606    34233     semillero semillero_cod_tso_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.semillero
    ADD CONSTRAINT semillero_cod_tso_fkey FOREIGN KEY (cod_tso) REFERENCES public.tipo_semillero(cod_tso);
 J   ALTER TABLE ONLY public.semillero DROP CONSTRAINT semillero_cod_tso_fkey;
       public       postgres    false    3087    244    258            b           2606    34671    socio socio_ide_ter_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.socio
    ADD CONSTRAINT socio_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 B   ALTER TABLE ONLY public.socio DROP CONSTRAINT socio_ide_ter_fkey;
       public       postgres    false    3081    253    246            c           2606    34248    stock stock_cod_ins_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY public.stock
    ADD CONSTRAINT stock_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);
 B   ALTER TABLE ONLY public.stock DROP CONSTRAINT stock_cod_ins_fkey;
       public       postgres    false    248    223    3047            D           2606    34253    desarrollar tarea_cod_tar_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.desarrollar
    ADD CONSTRAINT tarea_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);
 H   ALTER TABLE ONLY public.desarrollar DROP CONSTRAINT tarea_cod_tar_fkey;
       public       postgres    false    212    3077    250            G           2606    34258    efectuar tarea_cod_tar_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.efectuar
    ADD CONSTRAINT tarea_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);
 E   ALTER TABLE ONLY public.efectuar DROP CONSTRAINT tarea_cod_tar_fkey;
       public       postgres    false    215    3077    250            d           2606    34666 $   tel_tercero tel_tercero_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tel_tercero
    ADD CONSTRAINT tel_tercero_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 N   ALTER TABLE ONLY public.tel_tercero DROP CONSTRAINT tel_tercero_ide_ter_fkey;
       public       postgres    false    3081    252    253            e           2606    34268 2   tipo_de_produccion tipo_de_produccion_cod_unm_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tipo_de_produccion
    ADD CONSTRAINT tipo_de_produccion_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);
 \   ALTER TABLE ONLY public.tipo_de_produccion DROP CONSTRAINT tipo_de_produccion_cod_unm_fkey;
       public       postgres    false    3093    264    254            f           2606    34716 "   trabajador trabajador_ide_ter_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.trabajador
    ADD CONSTRAINT trabajador_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);
 L   ALTER TABLE ONLY public.trabajador DROP CONSTRAINT trabajador_ide_ter_fkey;
       public       postgres    false    262    253    3081            g           2606    34278 .   unidad_de_medida unidad_de_medida_cod_tum_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.unidad_de_medida
    ADD CONSTRAINT unidad_de_medida_cod_tum_fkey FOREIGN KEY (cod_tum) REFERENCES public.tipo_unidad_medida(cod_tum);
 X   ALTER TABLE ONLY public.unidad_de_medida DROP CONSTRAINT unidad_de_medida_cod_tum_fkey;
       public       postgres    false    264    3089    260            h           2606    34283    utilizar utilizar_cod_sto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.utilizar
    ADD CONSTRAINT utilizar_cod_sto_fkey FOREIGN KEY (cod_sto) REFERENCES public.stock(cod_sto);
 H   ALTER TABLE ONLY public.utilizar DROP CONSTRAINT utilizar_cod_sto_fkey;
       public       postgres    false    248    3075    268            i           2606    34288    utilizar utilizar_cod_tar_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.utilizar
    ADD CONSTRAINT utilizar_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);
 H   ALTER TABLE ONLY public.utilizar DROP CONSTRAINT utilizar_cod_tar_fkey;
       public       postgres    false    3077    268    250            �   S   x�]��	�0�s�KK�ƿ]��	��Az��n�oZ
Nܷ�4����-�v�����^�1�O$;�+���0�'����&.�      �   2   x�33�4�540�475274�2���L-�L��,��M-�,L�b���� ��I      D      x������ � �      A      x������ � �      C      x������ � �      ?   Q   x�3�J�J�4��t�,�H�KU�51���WH��+.��,R���.�4B?��<��t}c��DN#N��Ûs2S�b���� E9      ;   '   x�3�542642���\��F&fƆ�f��\1z\\\ e��      �   {   x�]��B1C�dP�&M������}����Mq���Dg��®h��b��(+���7�f<5l����:>�c%�}���|��waI����2_�e�]@�����Ĥ�0�G��6�����^��X	      �   |   x�e�A� еܥ?��]z�s|Ĥ��/3���^< �LU]j]���Q[��ZF�F&n�f��5�K���yf�#~/��6�mP'��w�?��0[42	��Af���!�@��GD��@�      �      x�31�47�21�4������ w      �   c   x�eλ� ��}�i���肣#���] �헓�<��)�%�)���B���l��+B#��r���XDd��O�g�wF�!�	���V��s��;},�      �   L   x�U���0�w�K*L�&٥��Q^E~��/�h-{$�9�aNq��S��-��=?�p��Y�W�r�O�wD|qU"      �   m   x�=ͱ�@���y
/`�g�K�H��@73�9��ғ?/�i�4Oc"��n��kh�s��(�?�q,��B�WP�>/ݼY���������it���$�ED��z�      �      x�3��47����� 
��         <  x�EPˎ� <�_�TUi�GP@J R���{�a��ď��]iO�{<��'���@ɕ�*��p	cH�q���(+&\ymQ6�o��e���e��M�فqV��(��ȹU��&P�k�i��7���k	S������3}��U3�����	f��=��h�W��b2B�r ��Dl+�\�'`�B�lcw�m�M�	֬������	�6rnWs����ÿ�����-,9�n{�^T�]ly:ß�[by��İYm��$no�,���p`������8����|����ۆ�m��p`�j"�yD�>�r{            x������ � �         /   x�31�4�540�473�02�21�M-�,L�L�8���c���� �	L         -   x�34��47�240�P����\��ʐ��H�p�[r��qqq ��5         +   x�340�43�240�P�L@(Ce�L8�,�b���� 'L	F         �   x�U�;�0Dk�,��Ħ�AhV�b[�"��
��f�y3;g�LW=)�{���qvk�կ�Q���0�nn#�0�'����g�=�_��eW��T|%�H��r��(�z{��w�X����Ҍ�/�c�����J0�����E�h����Xߖݟ%/7���/iN��TW��
���8�m�]�      E      x������ � �      @      x������ � �      H      x������ � �      G      x������ � �         �   x�mϽj�0�Yz
��\]�{S<�P��t������F�;�髦1��pxU�GR���EG�x���ɂ	�/M���y�W"��� l��9 ���߻�!�/�O���k��r���pzU��ja��9�c��Fh��k�b���E���r�҈^�ktY:���`�7S�:��܍.�z�iӖ���玁�X,ә���/�U      
      x�34�t�+)JL��/�,�4������� R�         �   x�]�A� ��/�ز�����Ӧ�,�w��'(�C��A	6kQ4�� G"��R�ݩV��	��6�����l\Q�z2M��1��?��f3cTޒ���f��nbD:�	�u�
}R�׊W����X��_��:V9�         �   x�]PKN�0];��	�|�t�dۑ�bcZS��x��p���bĨ��=���mv0R�C@ݒ��c&ݼr�F��q<s�N�a�|�$��G>"T��n��o|���>sxg���pĎ56�SSr��x�HQv�-<�4�ī=��W�~�q���-�p�*m�5�A���9a�"q0|� ��<�PF�3��|���S�f��0�Y^(`�Z���i��Y8�DD��W:U����F)���2         @   x�E���0��]���%��� 
 ��Y��j�D�*Y��X�,����2?6Y	�g���d�k         �   x�-�1�0��9>�/Њ�+������.N�[q
.F[؞~=}'w-Q2�T�)�'CL_���5�DF8�<��"eZO<�l�;�8!]����<d��9�/!ˬ��ݨՅȦX��W��K�F�pp6�1w�0�������Y��>         F   x�37�t�Qp.M,���4�u�r�00426�4�4�0���/IU�*M�C�4�0Kg���4����� �1      I      x������ � �      B      x������ � �            x�m|�r˲�~Lʘ�~�)qS���V�� [T+���`��zף)CƉ�)���k��A��`f5�V�#Wf=��NV]U�5�~��`v�.ֻ�E?����Rs�� =� ��];����7���(���w��S�=�r~V��,��2i�ߪu1��\�]1K�#�sB?��#ߗ�4ֳ,>�J�����Oۻ����} ��%��^MU�|��(:��vRJ��x��	��E3����ofqp�Z�.���,M�`���0}�~����vCӣ �\���& �zS܏e7���6eC}����w�����Q@xC����[����b���=?^T%{pQ�v|������߶}�U-;> �B}�ZC@���B��_+���UQ�5iSl�
"�#�f=>�@���9�aBEٳ�l��z����+i2j�~;vQ8M[��ȣ�iVE���e��tLR3�-ۉ��=��XfD\O2&�m�z�"0mǺU# �%�u �_c5ؔ@�tź��C{��'L1��}�C���J#��;���$K�����[�c�m]���e׍��5��d_�.����Ƀ:1�n]��uK�1!�MQk:X�-���S�%tVBx�J��9?~Wc�}��\W������)T'�n���L�B��TR�Ώ����yÎO�k�oms�y� e?t�p
��Q͸ ������M�P�mY�|���7E��4��GL�������~����"x�j��e��U_��$`��Rv����2��
H9�Q�K��AOd�^��gD�U�o��d��Rm��d�4���x�_a��;��d���{�t�[���]i$�̩1��p3�-ט=���\#�uQ�w�0�S4���L����c@)�siyDq�����I��y�"A�V�	;4O��6��-�<;���8�dL^8ٜ��4w}�xm�Q"֡��ꡰb"���{I���at��� �-���S�n1rYXD���};��g�8��̇������z�*r���䘝�������A4o�z���X�4{���e���e,7L���--%�D����d������U�鋨b��_�
��{�Tc���HA7oG8����7e����U�9�`}���MBMt�I�CG��8�0]�uL���]�����:\���d^�0��+:Sݜ���l8�8�Hs�8A1]�e�rNl�G�<���S��r�Ԙ���<�l���=����;���^��@Q�v?[�<͌��j~�u�G�^�YJ��5�/"�Z�B<	�2J$��k����k�MqF�I�+���`����`��	�KE1�m��� ��@
�����v�ӌ�Mhj�����82�7�����0�+Q�#&d�"�
Փ*����n���=�����`��(V�[,���td[F�h2�[�n��U7$4��5D��P�H&p^�b}O�]��B"&K��m�"2�J҃�5nm�%ف�s�j;�)���i2?>�t�����l���RZ�!�i�~JskܗƠ~�(T��B~�Qg�BE1~*˰R~�rVM��bU�dCJ����ѽF�#j�S�Л�Li���E�vn.��NK����vZv���q�A���~��q���Pb��<�Dk*�>�����+��' ǝRdla�rBEM����A��ex���QR[�d�v�����n>(��+$T`��F�.*ω�j^�!����h80!O��=���|i���UA|p5����s��xBR&1w��O(]��L`�'���|A�	��
�������N���|P����-���-�Q,&��3�|��=oJpF� I�*$ ���R<����W�r"i {�ҙ*a��N�Φ^����D��`�ʁ����Y����� o�������]6�J�( y�¤�QL��N[7L��Z��� ��=�YU���(�o��n(�p6�-��Q�2�l`.��P�P($�^�m�.�늟��ס��@
�
���=r�^��d1Făa@k��UF��	��k�M����+���ӑ�F��y`'	�ɬݢ������miCI.�vel��Z�{���d����?�O2��O\��.�Y˕[�$&�qհ��f�����G*k�[�5��5�=��J��<�0���2 �u�C;�n1>L�r�X���n��0� �ٸ27���d�>�c���#���Wn=�Ơ�#U����}����M1�N֢r���'r�ȜXX�W��`MAp�|-Y'��;�O�V#��|5v�\�m�Q�)��N�)rP�ҋ�
�>�g��'���Ggi0��g����22��oN[V��I&vr����՟�ΐ�T+�%�̙\-w8�1g�jdF�2��4�X�d�,s��GS�`����_��i�� �~�ϱ\u��A�nΘ:o1H�1����ޭv?���!�!�E����bj"V�V�2¿N�^$sߣR8�c�"իp̋�c��+V(iU��o^�$�_��P����r�JD� �Y0�2�n|�����"r��i�fV�#�L�ɂ3z$7�B�7�6w���x��l�	��~[5
�BO`�ʯ��Z��;�F�?����N�=a]$3q�^�CHLf�VB��+U��
������;L��.*}�A}A]����v?���r�(q�����޶����	����X�䓬����.��P��|�2��6+y�0^d��&w�l�@��X:KY�w��2�m�, `�pVfz���8��(�NR0�2ql>z�<T�l� ǁ�+��>ܛ��d�YKc���=P 6�Zi�-Q����`��p@��6XA:{�le� ��\����:P��@CR�\4Q�'�9qU+ڥ��#)<JPpd���	AG���_5�"�G��v%��{(��ڹ������w.9�w9ž�PP��,�~G!(�=2ߡ�.$��{:w���[�"h��v@#
�C����Gdӏ���AE�9�\<����~Aj����Q�����0e�T`#S�x�7AHT���I �F���-A@6�Ϗ�1���5p�
�B�ӹ��c��y�v�M�[��S�r��H�'���t��ޒb:Gp��͈�t�T�)Q�j�4���iq���[ti��S� '�3DF\j1���E�q��Tw�R�����T3irx�� $i:˯Cp�o���0�H��A�ęB2����$)���)���������VzQX.�w~Tc.�0,`A������iݢI�G�D�sa��,υo�Z��B�t����ƭ�����u�G�`�5yB5�?T��� ���P�%�0��j"O��\*�L[��9`Z5����_G^f�E��[ے�|"��65#�P�]g[�O��g�Hq�$s�i��s�&U ���!F`#���l~��M����G!�?�ō�2�VG��=�Bl$fx�:;؀��@,�u�v+��A���X%�@|(5�X只�ӷ���7���Z*��f+&�?L�gh k̪�\���"p��f�k��مNU0U"���V��X�#۪��2�]����"0�E?l�I£@���������ŀ\���8OnTA
F�H��&h�3E���7>�o�~2/�@�H��b����0t���$&឵��9��P��_=BT���(�0> er�1a| R���l%x����m|@��N-"�e1w'P��qI,SZ��?�Aw_�y��F���Ȇ�%Мʑ[3�)��	�\B(e&i�]&�t��E$.�6i#p
�-pD���4ߒ�t?䉠҉�U���S#�!�P��݋U�1zWQzX�(�F�̉��e�\7�W\d�\�_�RqUv��N�S���Q*��I���=�ʆ��}���~Nc'͏,�x�-����G�����R�5w�Ls'?Z�e�����8��#�Lh?�<��τ�cU�s9�3a]����Kד	��5�2��Ը��(Ke~�(�ѣ,;T��SH?M�dQ.���{���{�����Z_� |��8��+��cSu�U�dN�+0�    cD9��4��遪'`���'��#��%B��N�b��e�ԝ�`�K�Owb��e��j�����.K�~��}� �}_�AK���3?��.1�m5� �K|��ҍAB��_��7e.%'fmv��#�����]P51���AI���鸜 �؍<ca!0��*��1��r�sUX���.wo�G�W����#���Zt>�@IZ<F�j1���׍�FWQL&�*�РI$Dw�Y�������5v|>�*�<��W1D ��࣫�;׺����j�L<A'��'+��p���[�%І��2�$�<�@��?�H��%kL���q��!�7Փm\aC�o,*�CBƌ�W1Qs?&c1Ao�@��O!Qw���qz8&��f�sɊ� F�D�������0`k�u���ll���u�\,�Ib7֊����x
�}* ���]��U����c0dQ0�\R{����Lg���N�]H}�'�g'�7�������2�;�ƥ�Ơ2�cXg�<vU)݀/�AbW����&�$v�ɩɤ������4 !{LvUvf�Ů�5��Yh<��=��u�y�� @^W���e��a����.X���.�QIr�
v�X����`'�L�r'�1�I�u��?�S�T�[�l5Lה��u�&4��r��|ԔL	�mò<y�?)�vv�&�D��W�|�e��fAD�y/2ZF����$Έ��ٚo]��L�6Ȉbc�31��j�SJ(!��c0���dW@BW�g���t�6�� �I"FоA@����q��.u���#
��vb�{�\5��k�/��k��M�v�L1X溪]����]�_��U�I�/����hZw��6P�ww�@-׭%@,��\�m�/T2�Q������2���X����E'(�Qn��t���^^�AF�	îM�*��`��7sU����@%���V�wbϙk����Nn������f�i�u �ٍ�4��p�M׮�D*�ᖴ�+��hwJ��Gnzzq}��y }�5��Bɷ��	�
�R�Xw��Sqe-<`HuE�H��7���aku��/9�\�P\�(�
�9�a|��Uo��G�N�q28E�u�03����ȓ,;dI�\%��$�7s��� "�nU�vO/�x��yG�c��\NC��]%c#�m��m�.�޳\�V�}B�.�O""���q�$"б�Zb�|t�R"��8�q0iou��* %�?��3,JM9��aQ6}U?�<~ ��-�o���n��O@
���U/��=�t��� l0��y:j���f�C��	�"fcyfbX ��CN@�İ�r�V�a!�o�pâj�3�I�
���S�$%2�_p֤�	h�D�6�H`a��!	P��o]����o*����Q�mme��p[	�"X��NL�h�
�d1�`��Ё� 'ƚ@���9C����hXt�pw�ի��W���
��u;�ioЁ����"Ђ��2C�@�L�uv䓀L�P���E,l���XW-#^����E�	��‘��rU��{k�j!�+_.j%y2i��F� }Ѣ%N�vI����Y4�/��a1/Ez��/��Uw���'�yQ�N����iC-���޺˒q���T�7YN�]�����f^j{�*�[i�)�F���S/;�hi �J��}��~@��mӘ�T��Tl���t�2�h����{��$3Ą�J��E� ibG���{s�`�Soβ���+�7����GU�zzJ�jۼL}Z򲛕���\�1?�=�f\�[L�U_���L�7[����+N�����B�<��u`L��4GA7���?v��%G��x�Q)�E����O&�m)��c���̂� nV��	o���]h���?(��5�Q�j��w[ܷ�C�N�R��-��W�X8�ݖk���y� ����$��`q��GU)��;A�^�K}��]�ڴ ��e��\w�̽�0������30�-�k��Y{J�N��2���Z��>��+ML-S��m���%^)����_+��nە����G)�ŏ��H�'� �����7�zv(h��
�S��-<���OA{�<�WH�O��n"�I�A��.�I�q\W�8S��4��?9H�?i@��o��Rei	Z	R�U��Mfu˄�Z���dС��U�S�L�U[�J�o@��4�i�~�H���������K�XOA����N|
��>��N���o���W��ք3�t��&�m\���鋬2ɼW�5�=F�Q5G%#�ZW0��2▻B��m&I�PbS��Jg�,2��GK3��lG7!�K3"���1��f��jM=�V������K�C��r�lĒ{�
-8긤Յ��s?f���hu�4�1�2ϔG��mٸ��ih�'��NF�Sw���k�*�^�Jc�2�y����6lt�y�S��o�{���ʼ�@�c��`���^��yS]�2/z�S3fשR�����<��LC�63���(�|Vf��y����~i�����E�%�Sm�����~S"�|3�o���7#>����5�lM/ZTh�|(y*[m�u3�C�#����f{��������;����������텅��l���=�>uv�5�W5{@�7l)������Ye�[�K����>����YS#H_L�Re���A^�q�d�]�J�x��Y�*0�]�Q�W���b�]�,�mO>$	�}	�A�������Z5�/�J\����!���E��(�e���3Ѥ��B3����ʲț4�d\��JE�Qp�z�&
]�`OH��̹�����uj8��@#)-��"��A PB3Ȯ����@�ފ�����V��Vf���W�#d���
@��������j(~]�2�q�Jj^��̏͐��kQ����m-w�b3�c��]4��e���V�<� �e����iԕ��&�o؆n���o�q�X�^;��_��]��Yz��b/,W\G bqR�x�Px�K�Pf�+U{��v~|��G�V�e
3^}��+'ȶr����X��@�����*��N�3�,<Ǻx����r��uAx����Q��3����ߒ) a�E_�J���ҩ.�-%?���J��6{Q�k�Y����-[6Ͱ�^���4�Yp���H"C��e�oE7��i�V�B���řůkD��5����3�,����~��ɜ���mL���ܚ��u/��f�����,�1���BP�Y��Nw2�a��H�{=�3�F�9>���V��e������{f
R:���n\����v�s�$�i��3��)(��7_�3&A���3
){>�#�Q��v>�GrF�E�Ś��G�*����5�Ȏ�tT��C�5�=7~�8�]��a ��]�\T��{�v_�����VT����>/gP/�P"���b�*�#wׅ�j�{�꜒۝�+�M�	��`5gH q�)0�����)'����� �����nF)��n���v�[�k�S"jz;[��������|FIL[>,]����-�=ˉ���d�vS���[ޕ�Ώr�p;�e-
^�AήM����-o�v��K{VY�{����a�	22�-#���i��rR︚���|��E��s%����v,��pNv��Ą��*F�t:v�e��\:��w��^�7'�����}sW�r�'ώ��G�O*J�*)'�gx���ɞN���I��g��c���%uo~�~�Ζ��.P����t?'9.���ۉ�@���>W����pᒻ,X�9Xp���1���{�B���"H]�,=G�8��=�-y�[ih�z=�M��ws/!.t覴�!yJHS��Je�eٸ���]��Ԣ�@�n��j����,��Z8�˲�6�J@A$Y�����G�t�B�ظ�6�طvF��K W�����@ �~���R\j{���(��e�l
� q���0� *������������.j�~9��{{$����o4�9����	aVX�n���/g{9������\�l�C�D��+�؁&F� �b."����wpX`��f��_�[����с�jz O  #�yֽ<Q�<B�0QMo�=�t_ž.^N������~=�����,G�j�2��@o�==0�r�L/=�rl�����!�ө9�6��Cz` ɚ9R�R��<����Qb�L<	��M�����t�2� ��/�t�z:�*�}ZM��!���}��Ӟ6!��O�%g8��S3}���{���&�U��X^B�w��������7�+�0~S�I{ �Z�z�� (����A|��~7|�F��
����>�$�慎�|Fَ_4� ���n���,?����oE�=@��/�G #\mƮ _��d�+6P�Tm��z�8��j+���;���@nt�ۺ6Sjʵ3$������p�ol@,('�"��s������?�)�n���A-�u!E= ^�\!�q_vu��O�!�}����\}�W�z�{�g�P��t@���1��r�_�r&�����Qɽ�Y����ޟ&H:{�m���$4�ƥ�tId�Fo����P��$�*uK����g��ݛ����V�p�Ίf�k{g�?iyC�OнԬ(7T)h�iy������a�u]J�R)3ܪ&|�z�hp���>�) �?���lyԩxg���'��:c!(|(�t��g�Wz����O��٣d������N�I�S�Po�f7����R���ȫo&e�/����q���������Qa��O�˓�ٻ�����-�c{�/z��d��Y�7���KytB;�<��	������}H�̾�����@`� ����f����}���<�ZOg������ep����Q�z4����KD����t����Ɵ,�         B   x�36�4���M,IUpIU8��()?G�7�(?��ؐ�S�9#?�$_���!Txs�W� o"�         �   x�U�1�0��+� "JDA�h.�X�}�g�+^��p�(�V�ٝ#�=\i\$#,�4�\����£���>.�#�"j��ÅT�O�e�'���X�(
Μ3E�hR%a�"����O�:�QVM������n����������I�׿�1��5�| %*D
      F      x������ � �      J      x������ � �         �   x�}���@�3S�p�:�%����(����|��w�]ס�ݷ�n�H��&e�a-�����������$M*��Qb'0���	C�E�'J�
s*�q�8?��oQ�D
�m�$̸�f�����qc<�5�         C   x�33�43�4�521364�0�23�� IS.3c45��jL��1�Pc��Y�9��1z\\\ S�0         )   x�34�4�540��02715�24�MM��1W� ~�b         4   x�%ʹ  ��-a8������$�Qz
3�4��6�_�z3ɭ�, 	}          p   x�34�45�4�N����I,V���J-*IL2���|���9M��q�q�� E�R��P��М��(b���_���-9��2��P�
�E�
ũ�IE�E
Ve\1z\\\ �8&�      "   w   x�M�1�0Eg��@��ڤ�=@�],�C$Ӕ��'e�O���?����ѷ������F����&�~��,UhR�uzVY};'�Tr�D�!�>��b�~�
a�ה����[��"~#�&�      $      x�34�4�540�475274����� )��      &   7   x�-��  ��R�·��C��^&��`��v�`5pO�,0R�[��G+	�      (   o   x�37�4202�50�54F0�9M�8C�R�����rF�	���!H�[infzb�BriNIfY>��B�VKN3$�\��r����!�����gpjnRPY� ��$�      *   v   x�u��AC�C/�Ƙ��K��c��\s��<�v}�R���f�Oo�"bFR�p'<&g�V{�p�j*5�s*�?��#�en�9�y@��8�"!��:nUr0���G��\w����6�Z\(;      +   �   x�e�MN�0F��)z�A��4a	E��X�bcڨ�%-��g�s1L6�l=}z�pݝ-��	��.]���8�����\��(OW�8�,e��TQ����#1,Tg���š�N��L�!����Ʋ�Fi}�ef�����؃a7Q�Za��/� 6l����(�i+�p��BO/>��e�1�����
5O�L��Y�+_��"��)W��mw �K�T����i>��nk      >   C   x�3���+NM.�L�LI�2�t+�K���9��KR� <N�Ԣ$۔�/57�Ō3 �ʎ���� F�      ,   F   x�3�4�H,J���44�2�4�u/*M-�L@r�ɉ)`�!��3�2�\Rs����\fHJ�b���� �W�      .   )   x�3���M,IUHIU8��()?��I(�4�8�+F��� 2aR      0      x�3��9�0��4'Q�+F��� ;�Q      2   F   x�3�.-H-J�L�2�tN,HL�LIL�2��M,N�2���)�M��2J敀�8}���3KJS�b���� ��      =   >   x�3��L�����2��L���9==9s�2sr�L�< ��4�˔�3�3,�(%�+F��� �$�      4      x�32�4�52137�0������� "H-      6   �   x�e�9�0D����D68[�P�ti�b��H,�r�|C�"�G���IPV�Џ����$�Q�|@CS���}�_(ւR��K����E��v�v�c'D���8sW��8�Y4;#�=.��M]F���[uS�j}���
Yu��l�t@)�$廮� ��Yg�����G�{��_^�&8�~
��\�mCD/�CR�      8   ,   x�3�442a.#N�������0���Є˘�����b���� �	�      :   D   x�5���0C�3��$�K����R����Dʭ*Kk�c���Dɖ༶5�OY���pN'�{� `R     