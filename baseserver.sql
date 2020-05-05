

CREATE TABLE public.act_con (
    cod_con integer NOT NULL,
    ide_ter character varying(15) NOT NULL
);


ALTER TABLE public.act_con OWNER TO postgres;



CREATE TABLE public.act_cul (
    cod_cul integer NOT NULL,
    ide_ter character varying(15) NOT NULL
);


ALTER TABLE public.act_cul OWNER TO postgres;


CREATE TABLE public.afeccion (
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


ALTER TABLE public.afeccion OWNER TO postgres;


CREATE TABLE public.agr_x_eag (
    cod_eag character varying(6) NOT NULL,
    cod_agr character varying(6) NOT NULL
);


ALTER TABLE public.agr_x_eag OWNER TO postgres;


CREATE TABLE public.agr_x_mol (
    cod_agr character varying(6) NOT NULL,
    cod_mol character varying(6) NOT NULL,
    cac_agr character varying(6)
);


ALTER TABLE public.agr_x_mol OWNER TO postgres;



CREATE TABLE public.agroquimicos (
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


ALTER TABLE public.agroquimicos OWNER TO postgres;


CREATE TABLE public.cliente (
    ide_ter character varying(15) NOT NULL,
    cod_cli integer NOT NULL
);


ALTER TABLE public.cliente OWNER TO postgres;



CREATE SEQUENCE public.cliente_cod_cli_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cliente_cod_cli_seq OWNER TO postgres;

--
-- TOC entry 3410 (class 0 OID 0)
-- Dependencies: 203
-- Name: cliente_cod_cli_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cliente_cod_cli_seq OWNED BY public.cliente.cod_cli;


--
-- TOC entry 204 (class 1259 OID 52841)
-- Name: comprar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comprar (
    cod_com integer NOT NULL,
    ide_ter character varying(15) NOT NULL
);


ALTER TABLE public.comprar OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 52844)
-- Name: compras; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.compras (
    cod_com integer NOT NULL,
    fec_com date NOT NULL,
    tot_com integer
);


ALTER TABLE public.compras OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 52847)
-- Name: compras_cod_com_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.compras_cod_com_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.compras_cod_com_seq OWNER TO postgres;

--
-- TOC entry 3411 (class 0 OID 0)
-- Dependencies: 206
-- Name: compras_cod_com_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.compras_cod_com_seq OWNED BY public.compras.cod_com;


--
-- TOC entry 207 (class 1259 OID 52849)
-- Name: comun; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comun (
    cod_cun integer NOT NULL,
    cod_tar integer
);


ALTER TABLE public.comun OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 52852)
-- Name: comun_cod_cun_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.comun_cod_cun_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comun_cod_cun_seq OWNER TO postgres;

--
-- TOC entry 3412 (class 0 OID 0)
-- Dependencies: 208
-- Name: comun_cod_cun_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.comun_cod_cun_seq OWNED BY public.comun.cod_cun;


--
-- TOC entry 209 (class 1259 OID 52854)
-- Name: contratos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contratos (
    cod_cot integer NOT NULL,
    val_cot integer,
    des_cot character varying(45),
    cod_con integer,
    ffi_con date
);


ALTER TABLE public.contratos OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 52857)
-- Name: contratos_cod_cot_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contratos_cod_cot_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contratos_cod_cot_seq OWNER TO postgres;

--
-- TOC entry 3413 (class 0 OID 0)
-- Dependencies: 210
-- Name: contratos_cod_cot_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contratos_cod_cot_seq OWNED BY public.contratos.cod_cot;


--
-- TOC entry 211 (class 1259 OID 52859)
-- Name: convenio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.convenio (
    cod_con integer NOT NULL,
    fec_con date NOT NULL
);


ALTER TABLE public.convenio OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 52862)
-- Name: convenio_cod_con_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.convenio_cod_con_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.convenio_cod_con_seq OWNER TO postgres;

--
-- TOC entry 3414 (class 0 OID 0)
-- Dependencies: 212
-- Name: convenio_cod_con_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.convenio_cod_con_seq OWNED BY public.convenio.cod_con;


--
-- TOC entry 213 (class 1259 OID 52864)
-- Name: cultivos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cultivos (
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


ALTER TABLE public.cultivos OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 52867)
-- Name: cultivos_cod_cul_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cultivos_cod_cul_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cultivos_cod_cul_seq OWNER TO postgres;

--
-- TOC entry 3415 (class 0 OID 0)
-- Dependencies: 214
-- Name: cultivos_cod_cul_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cultivos_cod_cul_seq OWNED BY public.cultivos.cod_cul;


--
-- TOC entry 215 (class 1259 OID 52869)
-- Name: cultural; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cultural (
    cod_cut integer NOT NULL,
    cod_tar integer
);


ALTER TABLE public.cultural OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 52872)
-- Name: cultural_cod_cut_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cultural_cod_cut_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cultural_cod_cut_seq OWNER TO postgres;

--
-- TOC entry 3416 (class 0 OID 0)
-- Dependencies: 216
-- Name: cultural_cod_cut_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cultural_cod_cut_seq OWNED BY public.cultural.cod_cut;


--
-- TOC entry 217 (class 1259 OID 52874)
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departamento (
    cod_dep character varying(2) NOT NULL,
    nom_dep character varying(60) NOT NULL
);


ALTER TABLE public.departamento OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 52877)
-- Name: desarrollar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.desarrollar (
    cod_tar integer,
    cod_lab integer
);


ALTER TABLE public.desarrollar OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 52880)
-- Name: dueño; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."dueño" (
    cod_due integer NOT NULL,
    ide_ter character varying(15)
);


ALTER TABLE public."dueño" OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 52883)
-- Name: dueño_cod_due_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."dueño_cod_due_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."dueño_cod_due_seq" OWNER TO postgres;

--
-- TOC entry 3417 (class 0 OID 0)
-- Dependencies: 220
-- Name: dueño_cod_due_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."dueño_cod_due_seq" OWNED BY public."dueño".cod_due;


--
-- TOC entry 221 (class 1259 OID 52885)
-- Name: efectuar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.efectuar (
    cod_con integer,
    cod_tar integer
);


ALTER TABLE public.efectuar OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 52888)
-- Name: ejecutar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ejecutar (
    cod_con integer NOT NULL,
    cod_cul integer NOT NULL
);


ALTER TABLE public.ejecutar OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 52891)
-- Name: email_tercero; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.email_tercero (
    ide_ter character varying(15) NOT NULL,
    ema_ter character varying(100) NOT NULL
);


ALTER TABLE public.email_tercero OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 52894)
-- Name: enfermedades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enfermedades (
    cod_afe character varying(6) NOT NULL,
    cod_enf character varying(6) NOT NULL,
    pat_enf character varying(50) NOT NULL
);


ALTER TABLE public.enfermedades OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 52897)
-- Name: estado_agroquimico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estado_agroquimico (
    cod_eag character varying(6) NOT NULL,
    det_eag character varying(15) NOT NULL
);


ALTER TABLE public.estado_agroquimico OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 52900)
-- Name: eta_x_afe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.eta_x_afe (
    cod_afe character varying(6) NOT NULL,
    cod_eta character varying(6) NOT NULL
);


ALTER TABLE public.eta_x_afe OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 52903)
-- Name: etapas_crecimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etapas_crecimiento (
    cod_eta character varying(6) NOT NULL,
    det_eta character varying(50) NOT NULL,
    ima_eta character varying(100) NOT NULL
);


ALTER TABLE public.etapas_crecimiento OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 52906)
-- Name: fincas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fincas (
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


ALTER TABLE public.fincas OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 52912)
-- Name: fincas_cnt_fin_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fincas_cnt_fin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fincas_cnt_fin_seq OWNER TO postgres;

--
-- TOC entry 3418 (class 0 OID 0)
-- Dependencies: 229
-- Name: fincas_cnt_fin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fincas_cnt_fin_seq OWNED BY public.fincas.cnt_fin;


--
-- TOC entry 230 (class 1259 OID 52914)
-- Name: fitosanitaria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fitosanitaria (
    cod_fit integer NOT NULL,
    enf_fit character varying(45) NOT NULL,
    cod_tar integer
);


ALTER TABLE public.fitosanitaria OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 52917)
-- Name: fitosanitaria_cod_fit_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fitosanitaria_cod_fit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fitosanitaria_cod_fit_seq OWNER TO postgres;

--
-- TOC entry 3419 (class 0 OID 0)
-- Dependencies: 231
-- Name: fitosanitaria_cod_fit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fitosanitaria_cod_fit_seq OWNED BY public.fitosanitaria.cod_fit;


--
-- TOC entry 232 (class 1259 OID 52919)
-- Name: gozar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.gozar (
    cod_tpr integer NOT NULL,
    cod_pro integer NOT NULL,
    fec_goz date NOT NULL,
    ctp_goz integer,
    pre_goz integer,
    cpt_goz character varying
);


ALTER TABLE public.gozar OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 52925)
-- Name: insumos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.insumos (
    cod_ins integer NOT NULL,
    des_ins character varying(45) NOT NULL,
    cod_unm integer
);


ALTER TABLE public.insumos OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 52928)
-- Name: insumos_cod_ins_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.insumos_cod_ins_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.insumos_cod_ins_seq OWNER TO postgres;

--
-- TOC entry 3420 (class 0 OID 0)
-- Dependencies: 234
-- Name: insumos_cod_ins_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.insumos_cod_ins_seq OWNED BY public.insumos.cod_ins;


--
-- TOC entry 235 (class 1259 OID 52930)
-- Name: jornales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jornales (
    cod_jor integer NOT NULL,
    hor_jor integer,
    vho_jor integer,
    cod_con integer
);


ALTER TABLE public.jornales OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 52933)
-- Name: jornales_cod_jor_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jornales_cod_jor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jornales_cod_jor_seq OWNER TO postgres;

--
-- TOC entry 3421 (class 0 OID 0)
-- Dependencies: 236
-- Name: jornales_cod_jor_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jornales_cod_jor_seq OWNED BY public.jornales.cod_jor;


--
-- TOC entry 237 (class 1259 OID 52935)
-- Name: labores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.labores (
    cod_lab integer NOT NULL,
    nom_lab character varying(45) NOT NULL,
    det_lab character varying(300)
);


ALTER TABLE public.labores OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 52938)
-- Name: labores_cod_lab_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.labores_cod_lab_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.labores_cod_lab_seq OWNER TO postgres;

--
-- TOC entry 3422 (class 0 OID 0)
-- Dependencies: 238
-- Name: labores_cod_lab_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.labores_cod_lab_seq OWNED BY public.labores.cod_lab;


--
-- TOC entry 239 (class 1259 OID 52940)
-- Name: lotes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lotes (
    cod_lot integer NOT NULL,
    nom_lot character varying(45) NOT NULL,
    cod_fin character varying(20),
    cod_unm integer,
    med_lot character varying(5) NOT NULL
);


ALTER TABLE public.lotes OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 52943)
-- Name: lotes_cod_lot_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lotes_cod_lot_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lotes_cod_lot_seq OWNER TO postgres;

--
-- TOC entry 3423 (class 0 OID 0)
-- Dependencies: 240
-- Name: lotes_cod_lot_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lotes_cod_lot_seq OWNED BY public.lotes.cod_lot;


--
-- TOC entry 241 (class 1259 OID 52945)
-- Name: mol_x_afe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mol_x_afe (
    cod_mol character varying(6) NOT NULL,
    cod_afe character varying(6) NOT NULL,
    cod_eta character varying(6) NOT NULL
);


ALTER TABLE public.mol_x_afe OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 52948)
-- Name: moleculas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.moleculas (
    cod_mol character varying(6) NOT NULL,
    des_mol character varying(50) NOT NULL,
    pro_mol character varying(3) NOT NULL
);


ALTER TABLE public.moleculas OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 52951)
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.municipio (
    cod_mun character varying(4) NOT NULL,
    nom_mun character varying(45) NOT NULL,
    cod_dep character varying(2)
);


ALTER TABLE public.municipio OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 52954)
-- Name: nombre_cultivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nombre_cultivo (
    cod_ncu integer NOT NULL,
    des_ncu character varying(45) NOT NULL
);


ALTER TABLE public.nombre_cultivo OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 52957)
-- Name: nombre_cultivo_cod_ncu_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nombre_cultivo_cod_ncu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nombre_cultivo_cod_ncu_seq OWNER TO postgres;

--
-- TOC entry 3424 (class 0 OID 0)
-- Dependencies: 245
-- Name: nombre_cultivo_cod_ncu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nombre_cultivo_cod_ncu_seq OWNED BY public.nombre_cultivo.cod_ncu;


--
-- TOC entry 246 (class 1259 OID 52959)
-- Name: otros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.otros (
    cod_otr integer NOT NULL,
    cod_ins integer,
    det_otr character varying(50)
);


ALTER TABLE public.otros OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 52962)
-- Name: otros_cod_otr_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.otros_cod_otr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.otros_cod_otr_seq OWNER TO postgres;

--
-- TOC entry 3425 (class 0 OID 0)
-- Dependencies: 247
-- Name: otros_cod_otr_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.otros_cod_otr_seq OWNED BY public.otros.cod_otr;


--
-- TOC entry 248 (class 1259 OID 52964)
-- Name: plagas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plagas (
    cod_afe character varying(6) NOT NULL,
    cod_plg character varying(6) NOT NULL,
    tip_plg character varying(50) NOT NULL
);


ALTER TABLE public.plagas OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 52967)
-- Name: planificacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.planificacion (
    cod_pla character varying(6) NOT NULL,
    fec_pla date NOT NULL,
    epo_pla character varying(100) NOT NULL
);


ALTER TABLE public.planificacion OWNER TO postgres;

--
-- TOC entry 250 (class 1259 OID 52970)
-- Name: pre_sto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pre_sto (
    fec_cin character varying(30) NOT NULL,
    cod_sto integer NOT NULL,
    pre_sto integer,
    cod_pre integer NOT NULL
);


ALTER TABLE public.pre_sto OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 52973)
-- Name: pre_sto_cod_pre_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pre_sto_cod_pre_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pre_sto_cod_pre_seq OWNER TO postgres;

--
-- TOC entry 3426 (class 0 OID 0)
-- Dependencies: 251
-- Name: pre_sto_cod_pre_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pre_sto_cod_pre_seq OWNED BY public.pre_sto.cod_pre;


--
-- TOC entry 252 (class 1259 OID 52975)
-- Name: produccion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produccion (
    cod_pro integer NOT NULL,
    cod_cul integer,
    ide_ter character varying(15)
);


ALTER TABLE public.produccion OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 52978)
-- Name: produccion_cod_pro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produccion_cod_pro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produccion_cod_pro_seq OWNER TO postgres;

--
-- TOC entry 3427 (class 0 OID 0)
-- Dependencies: 253
-- Name: produccion_cod_pro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produccion_cod_pro_seq OWNED BY public.produccion.cod_pro;


--
-- TOC entry 254 (class 1259 OID 52980)
-- Name: proveedor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proveedor (
    cod_pro integer NOT NULL,
    ide_ter character varying(15)
);


ALTER TABLE public.proveedor OWNER TO postgres;

--
-- TOC entry 255 (class 1259 OID 52983)
-- Name: proveedor_cod_pro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.proveedor_cod_pro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proveedor_cod_pro_seq OWNER TO postgres;

--
-- TOC entry 3428 (class 0 OID 0)
-- Dependencies: 255
-- Name: proveedor_cod_pro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.proveedor_cod_pro_seq OWNED BY public.proveedor.cod_pro;


--
-- TOC entry 256 (class 1259 OID 52985)
-- Name: registrar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registrar (
    cod_com integer NOT NULL,
    cod_sto integer NOT NULL
);


ALTER TABLE public.registrar OWNER TO postgres;

--
-- TOC entry 257 (class 1259 OID 52988)
-- Name: semillas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.semillas (
    cod_sem integer NOT NULL,
    cod_ins integer,
    cod_tsa integer,
    det_sem character varying(50)
);


ALTER TABLE public.semillas OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 52991)
-- Name: semillas_cod_sem_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.semillas_cod_sem_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.semillas_cod_sem_seq OWNER TO postgres;

--
-- TOC entry 3429 (class 0 OID 0)
-- Dependencies: 258
-- Name: semillas_cod_sem_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.semillas_cod_sem_seq OWNED BY public.semillas.cod_sem;


--
-- TOC entry 259 (class 1259 OID 52993)
-- Name: semillero; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.semillero (
    cod_smr integer NOT NULL,
    cod_ins integer,
    cod_tso integer,
    det_smr character varying(50)
);


ALTER TABLE public.semillero OWNER TO postgres;

--
-- TOC entry 260 (class 1259 OID 52996)
-- Name: semillero_cod_smr_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.semillero_cod_smr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.semillero_cod_smr_seq OWNER TO postgres;

--
-- TOC entry 3430 (class 0 OID 0)
-- Dependencies: 260
-- Name: semillero_cod_smr_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.semillero_cod_smr_seq OWNED BY public.semillero.cod_smr;


--
-- TOC entry 261 (class 1259 OID 52998)
-- Name: socio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.socio (
    cod_soc integer NOT NULL,
    ide_ter character varying(15)
);


ALTER TABLE public.socio OWNER TO postgres;

--
-- TOC entry 262 (class 1259 OID 53001)
-- Name: socio_cod_soc_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.socio_cod_soc_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.socio_cod_soc_seq OWNER TO postgres;

--
-- TOC entry 3431 (class 0 OID 0)
-- Dependencies: 262
-- Name: socio_cod_soc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.socio_cod_soc_seq OWNED BY public.socio.cod_soc;


--
-- TOC entry 263 (class 1259 OID 53003)
-- Name: stock; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.stock (
    cod_sto integer NOT NULL,
    can_sto integer,
    cod_ins integer
);


ALTER TABLE public.stock OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 53006)
-- Name: stock_cod_sto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.stock_cod_sto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.stock_cod_sto_seq OWNER TO postgres;

--
-- TOC entry 3432 (class 0 OID 0)
-- Dependencies: 264
-- Name: stock_cod_sto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.stock_cod_sto_seq OWNED BY public.stock.cod_sto;


--
-- TOC entry 265 (class 1259 OID 53008)
-- Name: tarea; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tarea (
    cod_tar integer NOT NULL,
    fin_tar date NOT NULL,
    ffi_tar date,
    val_tar integer,
    des_tar character varying(45)
);


ALTER TABLE public.tarea OWNER TO postgres;

--
-- TOC entry 266 (class 1259 OID 53011)
-- Name: tarea_cod_tar_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tarea_cod_tar_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tarea_cod_tar_seq OWNER TO postgres;

--
-- TOC entry 3433 (class 0 OID 0)
-- Dependencies: 266
-- Name: tarea_cod_tar_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tarea_cod_tar_seq OWNED BY public.tarea.cod_tar;


--
-- TOC entry 267 (class 1259 OID 53013)
-- Name: tel_tercero; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tel_tercero (
    ide_ter character varying(15) NOT NULL,
    tel_ter character varying(11) NOT NULL
);


ALTER TABLE public.tel_tercero OWNER TO postgres;

--
-- TOC entry 268 (class 1259 OID 53016)
-- Name: terceros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.terceros (
    ide_ter character varying(15) NOT NULL,
    pno_ter character varying(20) NOT NULL,
    sno_ter character varying(20) NOT NULL,
    pap_ter character varying(20) NOT NULL,
    sap_ter character varying(20) NOT NULL
);


ALTER TABLE public.terceros OWNER TO postgres;

--
-- TOC entry 269 (class 1259 OID 53019)
-- Name: tipo_agroquimico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_agroquimico (
    cod_tag character varying(6) NOT NULL,
    det_tag character varying(20) NOT NULL
);


ALTER TABLE public.tipo_agroquimico OWNER TO postgres;

--
-- TOC entry 270 (class 1259 OID 53022)
-- Name: tipo_de_produccion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_de_produccion (
    cod_tpr integer NOT NULL,
    des_tpr character varying(45) NOT NULL,
    cod_unm integer
);


ALTER TABLE public.tipo_de_produccion OWNER TO postgres;

--
-- TOC entry 271 (class 1259 OID 53025)
-- Name: tipo_de_produccion_cod_tpr_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_de_produccion_cod_tpr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_de_produccion_cod_tpr_seq OWNER TO postgres;

--
-- TOC entry 3434 (class 0 OID 0)
-- Dependencies: 271
-- Name: tipo_de_produccion_cod_tpr_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_de_produccion_cod_tpr_seq OWNED BY public.tipo_de_produccion.cod_tpr;


--
-- TOC entry 272 (class 1259 OID 53027)
-- Name: tipo_semilla; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_semilla (
    cod_tsa integer NOT NULL,
    det_tsa character varying(20) NOT NULL
);


ALTER TABLE public.tipo_semilla OWNER TO postgres;

--
-- TOC entry 273 (class 1259 OID 53030)
-- Name: tipo_semilla_cod_tsa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_semilla_cod_tsa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_semilla_cod_tsa_seq OWNER TO postgres;

--
-- TOC entry 3435 (class 0 OID 0)
-- Dependencies: 273
-- Name: tipo_semilla_cod_tsa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_semilla_cod_tsa_seq OWNED BY public.tipo_semilla.cod_tsa;


--
-- TOC entry 274 (class 1259 OID 53032)
-- Name: tipo_semillero; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_semillero (
    cod_tso integer NOT NULL,
    det_tso character varying(20) NOT NULL
);


ALTER TABLE public.tipo_semillero OWNER TO postgres;

--
-- TOC entry 275 (class 1259 OID 53035)
-- Name: tipo_semillero_cod_tso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_semillero_cod_tso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_semillero_cod_tso_seq OWNER TO postgres;

--
-- TOC entry 3436 (class 0 OID 0)
-- Dependencies: 275
-- Name: tipo_semillero_cod_tso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_semillero_cod_tso_seq OWNED BY public.tipo_semillero.cod_tso;


--
-- TOC entry 276 (class 1259 OID 53037)
-- Name: tipo_unidad_medida; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_unidad_medida (
    cod_tum integer NOT NULL,
    des_tum character varying(45) NOT NULL
);


ALTER TABLE public.tipo_unidad_medida OWNER TO postgres;

--
-- TOC entry 277 (class 1259 OID 53040)
-- Name: tipo_unidad_medida_cod_tum_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_unidad_medida_cod_tum_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_unidad_medida_cod_tum_seq OWNER TO postgres;

--
-- TOC entry 3437 (class 0 OID 0)
-- Dependencies: 277
-- Name: tipo_unidad_medida_cod_tum_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_unidad_medida_cod_tum_seq OWNED BY public.tipo_unidad_medida.cod_tum;


--
-- TOC entry 278 (class 1259 OID 53042)
-- Name: toxicidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.toxicidad (
    cod_tox character varying(6) NOT NULL,
    det_tox character varying(20) NOT NULL,
    col_tox character varying(10) NOT NULL
);


ALTER TABLE public.toxicidad OWNER TO postgres;

--
-- TOC entry 279 (class 1259 OID 53045)
-- Name: trabajador; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.trabajador (
    cod_tra integer NOT NULL,
    ide_ter character varying(15)
);


ALTER TABLE public.trabajador OWNER TO postgres;

--
-- TOC entry 280 (class 1259 OID 53048)
-- Name: trabajador_cod_tra_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.trabajador_cod_tra_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trabajador_cod_tra_seq OWNER TO postgres;

--
-- TOC entry 3438 (class 0 OID 0)
-- Dependencies: 280
-- Name: trabajador_cod_tra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.trabajador_cod_tra_seq OWNED BY public.trabajador.cod_tra;


--
-- TOC entry 281 (class 1259 OID 53050)
-- Name: unidad_de_medida; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unidad_de_medida (
    cod_unm integer NOT NULL,
    des_unm character varying(30) NOT NULL,
    cod_tum integer,
    equ_med bigint
);


ALTER TABLE public.unidad_de_medida OWNER TO postgres;

--
-- TOC entry 282 (class 1259 OID 53053)
-- Name: unidad_de_medida_cod_unm_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.unidad_de_medida_cod_unm_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.unidad_de_medida_cod_unm_seq OWNER TO postgres;

--
-- TOC entry 3439 (class 0 OID 0)
-- Dependencies: 282
-- Name: unidad_de_medida_cod_unm_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.unidad_de_medida_cod_unm_seq OWNED BY public.unidad_de_medida.cod_unm;


--
-- TOC entry 283 (class 1259 OID 53055)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id_usu integer NOT NULL,
    usu_usu character varying(20),
    pas_usu character varying(20)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 284 (class 1259 OID 53058)
-- Name: usuario_id_usu_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_usu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_usu_seq OWNER TO postgres;

--
-- TOC entry 3440 (class 0 OID 0)
-- Dependencies: 284
-- Name: usuario_id_usu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_id_usu_seq OWNED BY public.usuario.id_usu;


--
-- TOC entry 285 (class 1259 OID 53060)
-- Name: utilizar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilizar (
    cod_sto integer NOT NULL,
    cod_tar integer NOT NULL,
    cin_tar integer NOT NULL,
    pin_tar character varying(8),
    cod_uti integer NOT NULL
);


ALTER TABLE public.utilizar OWNER TO postgres;

--
-- TOC entry 286 (class 1259 OID 53063)
-- Name: utilizar_cod_uti_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utilizar_cod_uti_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilizar_cod_uti_seq OWNER TO postgres;

--
-- TOC entry 3441 (class 0 OID 0)
-- Dependencies: 286
-- Name: utilizar_cod_uti_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utilizar_cod_uti_seq OWNED BY public.utilizar.cod_uti;


--
-- TOC entry 2982 (class 2604 OID 53065)
-- Name: cliente cod_cli; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente ALTER COLUMN cod_cli SET DEFAULT nextval('public.cliente_cod_cli_seq'::regclass);


--
-- TOC entry 2983 (class 2604 OID 53066)
-- Name: compras cod_com; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compras ALTER COLUMN cod_com SET DEFAULT nextval('public.compras_cod_com_seq'::regclass);


--
-- TOC entry 2984 (class 2604 OID 53067)
-- Name: comun cod_cun; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comun ALTER COLUMN cod_cun SET DEFAULT nextval('public.comun_cod_cun_seq'::regclass);


--
-- TOC entry 2985 (class 2604 OID 53068)
-- Name: contratos cod_cot; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contratos ALTER COLUMN cod_cot SET DEFAULT nextval('public.contratos_cod_cot_seq'::regclass);


--
-- TOC entry 2986 (class 2604 OID 53069)
-- Name: convenio cod_con; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.convenio ALTER COLUMN cod_con SET DEFAULT nextval('public.convenio_cod_con_seq'::regclass);


--
-- TOC entry 2987 (class 2604 OID 53070)
-- Name: cultivos cod_cul; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultivos ALTER COLUMN cod_cul SET DEFAULT nextval('public.cultivos_cod_cul_seq'::regclass);


--
-- TOC entry 2988 (class 2604 OID 53071)
-- Name: cultural cod_cut; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultural ALTER COLUMN cod_cut SET DEFAULT nextval('public.cultural_cod_cut_seq'::regclass);


--
-- TOC entry 2989 (class 2604 OID 53072)
-- Name: dueño cod_due; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."dueño" ALTER COLUMN cod_due SET DEFAULT nextval('public."dueño_cod_due_seq"'::regclass);


--
-- TOC entry 2990 (class 2604 OID 53073)
-- Name: fincas cnt_fin; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fincas ALTER COLUMN cnt_fin SET DEFAULT nextval('public.fincas_cnt_fin_seq'::regclass);


--
-- TOC entry 2991 (class 2604 OID 53074)
-- Name: fitosanitaria cod_fit; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fitosanitaria ALTER COLUMN cod_fit SET DEFAULT nextval('public.fitosanitaria_cod_fit_seq'::regclass);


--
-- TOC entry 2992 (class 2604 OID 53075)
-- Name: insumos cod_ins; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.insumos ALTER COLUMN cod_ins SET DEFAULT nextval('public.insumos_cod_ins_seq'::regclass);


--
-- TOC entry 2993 (class 2604 OID 53076)
-- Name: jornales cod_jor; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jornales ALTER COLUMN cod_jor SET DEFAULT nextval('public.jornales_cod_jor_seq'::regclass);


--
-- TOC entry 2994 (class 2604 OID 53077)
-- Name: labores cod_lab; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labores ALTER COLUMN cod_lab SET DEFAULT nextval('public.labores_cod_lab_seq'::regclass);


--
-- TOC entry 2995 (class 2604 OID 53078)
-- Name: lotes cod_lot; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lotes ALTER COLUMN cod_lot SET DEFAULT nextval('public.lotes_cod_lot_seq'::regclass);


--
-- TOC entry 2996 (class 2604 OID 53079)
-- Name: nombre_cultivo cod_ncu; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nombre_cultivo ALTER COLUMN cod_ncu SET DEFAULT nextval('public.nombre_cultivo_cod_ncu_seq'::regclass);


--
-- TOC entry 2997 (class 2604 OID 53080)
-- Name: otros cod_otr; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otros ALTER COLUMN cod_otr SET DEFAULT nextval('public.otros_cod_otr_seq'::regclass);


--
-- TOC entry 2998 (class 2604 OID 53081)
-- Name: pre_sto cod_pre; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pre_sto ALTER COLUMN cod_pre SET DEFAULT nextval('public.pre_sto_cod_pre_seq'::regclass);


--
-- TOC entry 2999 (class 2604 OID 53082)
-- Name: produccion cod_pro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produccion ALTER COLUMN cod_pro SET DEFAULT nextval('public.produccion_cod_pro_seq'::regclass);


--
-- TOC entry 3000 (class 2604 OID 53083)
-- Name: proveedor cod_pro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proveedor ALTER COLUMN cod_pro SET DEFAULT nextval('public.proveedor_cod_pro_seq'::regclass);


--
-- TOC entry 3001 (class 2604 OID 53084)
-- Name: semillas cod_sem; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillas ALTER COLUMN cod_sem SET DEFAULT nextval('public.semillas_cod_sem_seq'::regclass);


--
-- TOC entry 3002 (class 2604 OID 53085)
-- Name: semillero cod_smr; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillero ALTER COLUMN cod_smr SET DEFAULT nextval('public.semillero_cod_smr_seq'::regclass);


--
-- TOC entry 3003 (class 2604 OID 53086)
-- Name: socio cod_soc; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.socio ALTER COLUMN cod_soc SET DEFAULT nextval('public.socio_cod_soc_seq'::regclass);


--
-- TOC entry 3004 (class 2604 OID 53087)
-- Name: stock cod_sto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stock ALTER COLUMN cod_sto SET DEFAULT nextval('public.stock_cod_sto_seq'::regclass);


--
-- TOC entry 3005 (class 2604 OID 53088)
-- Name: tarea cod_tar; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarea ALTER COLUMN cod_tar SET DEFAULT nextval('public.tarea_cod_tar_seq'::regclass);


--
-- TOC entry 3006 (class 2604 OID 53089)
-- Name: tipo_de_produccion cod_tpr; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_de_produccion ALTER COLUMN cod_tpr SET DEFAULT nextval('public.tipo_de_produccion_cod_tpr_seq'::regclass);


--
-- TOC entry 3007 (class 2604 OID 53090)
-- Name: tipo_semilla cod_tsa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_semilla ALTER COLUMN cod_tsa SET DEFAULT nextval('public.tipo_semilla_cod_tsa_seq'::regclass);


--
-- TOC entry 3008 (class 2604 OID 53091)
-- Name: tipo_semillero cod_tso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_semillero ALTER COLUMN cod_tso SET DEFAULT nextval('public.tipo_semillero_cod_tso_seq'::regclass);


--
-- TOC entry 3009 (class 2604 OID 53092)
-- Name: tipo_unidad_medida cod_tum; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_unidad_medida ALTER COLUMN cod_tum SET DEFAULT nextval('public.tipo_unidad_medida_cod_tum_seq'::regclass);


--
-- TOC entry 3010 (class 2604 OID 53093)
-- Name: trabajador cod_tra; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trabajador ALTER COLUMN cod_tra SET DEFAULT nextval('public.trabajador_cod_tra_seq'::regclass);


--
-- TOC entry 3011 (class 2604 OID 53094)
-- Name: unidad_de_medida cod_unm; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidad_de_medida ALTER COLUMN cod_unm SET DEFAULT nextval('public.unidad_de_medida_cod_unm_seq'::regclass);


--
-- TOC entry 3012 (class 2604 OID 53095)
-- Name: usuario id_usu; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id_usu SET DEFAULT nextval('public.usuario_id_usu_seq'::regclass);


--
-- TOC entry 3013 (class 2604 OID 53096)
-- Name: utilizar cod_uti; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilizar ALTER COLUMN cod_uti SET DEFAULT nextval('public.utilizar_cod_uti_seq'::regclass);


--
-- TOC entry 3314 (class 0 OID 52815)
-- Dependencies: 196
-- Data for Name: act_con; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.act_con (cod_con, ide_ter) FROM stdin;
\.


--
-- TOC entry 3315 (class 0 OID 52818)
-- Dependencies: 197
-- Data for Name: act_cul; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.act_cul (cod_cul, ide_ter) FROM stdin;
\.


--
-- TOC entry 3316 (class 0 OID 52821)
-- Dependencies: 198
-- Data for Name: afeccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.afeccion (cod_afe, nom_afe, noc_afe, inc_afe, sin_afe, par_afe, epo_afe, tcv_afe, prv_afe, aet_afe, hat_afe) FROM stdin;
\.


--
-- TOC entry 3317 (class 0 OID 52827)
-- Dependencies: 199
-- Data for Name: agr_x_eag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.agr_x_eag (cod_eag, cod_agr) FROM stdin;
\.


--
-- TOC entry 3318 (class 0 OID 52830)
-- Dependencies: 200
-- Data for Name: agr_x_mol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.agr_x_mol (cod_agr, cod_mol, cac_agr) FROM stdin;
\.


--
-- TOC entry 3319 (class 0 OID 52833)
-- Dependencies: 201
-- Data for Name: agroquimicos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.agroquimicos (cod_agr, cod_ins, det_agr, rec_agr, pcr_agr, pen_agr, pro_agr, for_agr, cod_tag, cod_tox, est_agr) FROM stdin;
\.


--
-- TOC entry 3320 (class 0 OID 52836)
-- Dependencies: 202
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (ide_ter, cod_cli) FROM stdin;
\.


--
-- TOC entry 3322 (class 0 OID 52841)
-- Dependencies: 204
-- Data for Name: comprar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comprar (cod_com, ide_ter) FROM stdin;
\.


--
-- TOC entry 3323 (class 0 OID 52844)
-- Dependencies: 205
-- Data for Name: compras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.compras (cod_com, fec_com, tot_com) FROM stdin;
\.


--
-- TOC entry 3325 (class 0 OID 52849)
-- Dependencies: 207
-- Data for Name: comun; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comun (cod_cun, cod_tar) FROM stdin;
\.


--
-- TOC entry 3327 (class 0 OID 52854)
-- Dependencies: 209
-- Data for Name: contratos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contratos (cod_cot, val_cot, des_cot, cod_con, ffi_con) FROM stdin;
\.


--
-- TOC entry 3329 (class 0 OID 52859)
-- Dependencies: 211
-- Data for Name: convenio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.convenio (cod_con, fec_con) FROM stdin;
\.


--
-- TOC entry 3331 (class 0 OID 52864)
-- Dependencies: 213
-- Data for Name: cultivos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cultivos (cod_cul, fin_cul, fif_cul, npl_cul, tip_cul, dur_cul, est_cul, cod_ncu, cod_lot, dia_cul, mod_cul) FROM stdin;
\.


--
-- TOC entry 3333 (class 0 OID 52869)
-- Dependencies: 215
-- Data for Name: cultural; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cultural (cod_cut, cod_tar) FROM stdin;
\.


--
-- TOC entry 3335 (class 0 OID 52874)
-- Dependencies: 217
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.departamento (cod_dep, nom_dep) FROM stdin;
5	ANTIOQUIA
8	ATLÁNTICO
11	BOGOTÁ, D.C.
13	BOLÍVAR
15	BOYACÁ
17	CALDAS
18	CAQUETÁ
19	CAUCA
20	CESAR
23	CÓRDOBA
25	CUNDINAMARCA
27	CHOCÓ
41	HUILA
44	LA GUAJIRA
47	MAGDALENA
50	META
52	NARIÑO
54	NORTE DE SANTANDER
63	QUINDIO
66	RISARALDA
68	SANTANDER
70	SUCRE
73	TOLIMA
76	VALLE DEL CAUCA
81	ARAUCA
85	CASANARE
86	PUTUMAYO
88	ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA
91	AMAZONAS
94	GUAINÍA
95	GUAVIARE
97	VAUPÉS
99	VICHADA
\.


--
-- TOC entry 3336 (class 0 OID 52877)
-- Dependencies: 218
-- Data for Name: desarrollar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.desarrollar (cod_tar, cod_lab) FROM stdin;
\.


--
-- TOC entry 3337 (class 0 OID 52880)
-- Dependencies: 219
-- Data for Name: dueño; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."dueño" (cod_due, ide_ter) FROM stdin;
\.


--
-- TOC entry 3339 (class 0 OID 52885)
-- Dependencies: 221
-- Data for Name: efectuar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.efectuar (cod_con, cod_tar) FROM stdin;
\.


--
-- TOC entry 3340 (class 0 OID 52888)
-- Dependencies: 222
-- Data for Name: ejecutar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ejecutar (cod_con, cod_cul) FROM stdin;
\.


--
-- TOC entry 3341 (class 0 OID 52891)
-- Dependencies: 223
-- Data for Name: email_tercero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.email_tercero (ide_ter, ema_ter) FROM stdin;
\.


--
-- TOC entry 3342 (class 0 OID 52894)
-- Dependencies: 224
-- Data for Name: enfermedades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.enfermedades (cod_afe, cod_enf, pat_enf) FROM stdin;
\.


--
-- TOC entry 3343 (class 0 OID 52897)
-- Dependencies: 225
-- Data for Name: estado_agroquimico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estado_agroquimico (cod_eag, det_eag) FROM stdin;
\.


--
-- TOC entry 3344 (class 0 OID 52900)
-- Dependencies: 226
-- Data for Name: eta_x_afe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.eta_x_afe (cod_afe, cod_eta) FROM stdin;
\.


--
-- TOC entry 3345 (class 0 OID 52903)
-- Dependencies: 227
-- Data for Name: etapas_crecimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.etapas_crecimiento (cod_eta, det_eta, ima_eta) FROM stdin;
\.


--
-- TOC entry 3346 (class 0 OID 52906)
-- Dependencies: 228
-- Data for Name: fincas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fincas (cod_fin, nom_fin, det_fin, cod_dep, cod_mun, ide_ter, cod_unm, med_fin, cnt_fin, fot_fin) FROM stdin;
\.


--
-- TOC entry 3348 (class 0 OID 52914)
-- Dependencies: 230
-- Data for Name: fitosanitaria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fitosanitaria (cod_fit, enf_fit, cod_tar) FROM stdin;
\.


--
-- TOC entry 3350 (class 0 OID 52919)
-- Dependencies: 232
-- Data for Name: gozar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.gozar (cod_tpr, cod_pro, fec_goz, ctp_goz, pre_goz, cpt_goz) FROM stdin;
\.


--
-- TOC entry 3351 (class 0 OID 52925)
-- Dependencies: 233
-- Data for Name: insumos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.insumos (cod_ins, des_ins, cod_unm) FROM stdin;
\.


--
-- TOC entry 3353 (class 0 OID 52930)
-- Dependencies: 235
-- Data for Name: jornales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jornales (cod_jor, hor_jor, vho_jor, cod_con) FROM stdin;
\.


--
-- TOC entry 3355 (class 0 OID 52935)
-- Dependencies: 237
-- Data for Name: labores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.labores (cod_lab, nom_lab, det_lab) FROM stdin;
\.


--
-- TOC entry 3357 (class 0 OID 52940)
-- Dependencies: 239
-- Data for Name: lotes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lotes (cod_lot, nom_lot, cod_fin, cod_unm, med_lot) FROM stdin;
\.


--
-- TOC entry 3359 (class 0 OID 52945)
-- Dependencies: 241
-- Data for Name: mol_x_afe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mol_x_afe (cod_mol, cod_afe, cod_eta) FROM stdin;
\.


--
-- TOC entry 3360 (class 0 OID 52948)
-- Dependencies: 242
-- Data for Name: moleculas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.moleculas (cod_mol, des_mol, pro_mol) FROM stdin;
\.


--
-- TOC entry 3361 (class 0 OID 52951)
-- Dependencies: 243
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.municipio (cod_mun, nom_mun, cod_dep) FROM stdin;
1	Abriaquí	5
2	Acacías	50
3	Acandí	27
4	Acevedo	41
5	Achí	13
6	Agrado	41
7	Agua de Dios	25
8	Aguachica	20
9	Aguada	68
10	Aguadas	17
11	Aguazul	85
12	Agustín Codazzi	20
13	Aipe	41
14	Albania	18
15	Albania	44
16	Albania	68
17	Albán	25
18	Albán (San José)	52
19	Alcalá	76
20	Alejandria	5
21	Algarrobo	47
22	Algeciras	41
23	Almaguer	19
24	Almeida	15
25	Alpujarra	73
26	Altamira	41
27	Alto Baudó (Pie de Pato)	27
28	Altos del Rosario	13
29	Alvarado	73
30	Amagá	5
31	Amalfi	5
32	Ambalema	73
33	Anapoima	25
34	Ancuya	52
35	Andalucía	76
36	Andes	5
37	Angelópolis	5
38	Angostura	5
39	Anolaima	25
40	Anorí	5
41	Anserma	17
42	Ansermanuevo	76
43	Anzoátegui	73
44	Anzá	5
45	Apartadó	5
46	Apulo	25
47	Apía	66
48	Aquitania	15
49	Aracataca	47
50	Aranzazu	17
51	Aratoca	68
52	Arauca	81
53	Arauquita	81
54	Arbeláez	25
55	Arboleda (Berruecos)	52
56	Arboledas	54
57	Arboletes	5
58	Arcabuco	15
59	Arenal	13
60	Argelia	5
61	Argelia	19
62	Argelia	76
63	Ariguaní (El Difícil)	47
64	Arjona	13
65	Armenia	5
66	Armenia	63
67	Armero (Guayabal)	73
68	Arroyohondo	13
69	Astrea	20
70	Ataco	73
71	Atrato (Yuto)	27
72	Ayapel	23
73	Bagadó	27
74	Bahía Solano (Mútis)	27
75	Bajo Baudó (Pizarro)	27
76	Balboa	19
77	Balboa	66
78	Baranoa	8
79	Baraya	41
80	Barbacoas	52
81	Barbosa	5
82	Barbosa	68
83	Barichara	68
84	Barranca de Upía	50
85	Barrancabermeja	68
86	Barrancas	44
87	Barranco de Loba	13
88	Barranquilla	8
89	Becerríl	20
90	Belalcázar	17
91	Bello	5
92	Belmira	5
93	Beltrán	25
94	Belén	15
95	Belén	52
96	Belén de Bajirá	27
97	Belén de Umbría	66
98	Belén de los Andaquíes	18
99	Berbeo	15
100	Betania	5
101	Beteitiva	15
102	Betulia	5
103	Betulia	68
104	Bituima	25
105	Boavita	15
106	Bochalema	54
107	Bogotá D.C.	11
108	Bojacá	25
109	Bojayá (Bellavista)	27
110	Bolívar	5
111	Bolívar	19
112	Bolívar	68
113	Bolívar	76
114	Bosconia	20
115	Boyacá	15
116	Briceño	5
117	Briceño	15
118	Bucaramanga	68
119	Bucarasica	54
120	Buenaventura	76
121	Buenavista	15
122	Buenavista	23
123	Buenavista	63
124	Buenavista	70
125	Buenos Aires	19
126	Buesaco	52
127	Buga	76
128	Bugalagrande	76
129	Burítica	5
130	Busbanza	15
131	Cabrera	25
132	Cabrera	68
133	Cabuyaro	50
134	Cachipay	25
135	Caicedo	5
136	Caicedonia	76
137	Caimito	70
138	Cajamarca	73
139	Cajibío	19
140	Cajicá	25
141	Calamar	13
142	Calamar	95
143	Calarcá	63
144	Caldas	5
145	Caldas	15
146	Caldono	19
147	California	68
148	Calima (Darién)	76
149	Caloto	19
150	Calí	76
151	Campamento	5
152	Campo de la Cruz	8
153	Campoalegre	41
154	Campohermoso	15
155	Canalete	23
156	Candelaria	8
157	Candelaria	76
158	Cantagallo	13
159	Cantón de San Pablo	27
160	Caparrapí	25
161	Capitanejo	68
162	Caracolí	5
163	Caramanta	5
164	Carcasí	68
165	Carepa	5
166	Carmen de Apicalá	73
167	Carmen de Carupa	25
168	Carmen de Viboral	5
169	Carmen del Darién (CURBARADÓ)	27
170	Carolina	5
171	Cartagena	13
172	Cartagena del Chairá	18
173	Cartago	76
174	Carurú	97
175	Casabianca	73
176	Castilla la Nueva	50
177	Caucasia	5
178	Cañasgordas	5
179	Cepita	68
180	Cereté	23
181	Cerinza	15
182	Cerrito	68
183	Cerro San Antonio	47
184	Chachaguí	52
185	Chaguaní	25
186	Chalán	70
187	Chaparral	73
188	Charalá	68
189	Charta	68
190	Chigorodó	5
191	Chima	68
192	Chimichagua	20
193	Chimá	23
194	Chinavita	15
195	Chinchiná	17
196	Chinácota	54
197	Chinú	23
198	Chipaque	25
199	Chipatá	68
200	Chiquinquirá	15
201	Chiriguaná	20
202	Chiscas	15
203	Chita	15
204	Chitagá	54
205	Chitaraque	15
206	Chivatá	15
207	Chivolo	47
208	Choachí	25
209	Chocontá	25
210	Chámeza	85
211	Chía	25
212	Chíquiza	15
213	Chívor	15
214	Cicuco	13
215	Cimitarra	68
216	Circasia	63
217	Cisneros	5
218	Ciénaga	15
219	Ciénaga	47
220	Ciénaga de Oro	23
221	Clemencia	13
222	Cocorná	5
223	Coello	73
224	Cogua	25
225	Colombia	41
226	Colosó (Ricaurte)	70
227	Colón	86
228	Colón (Génova)	52
229	Concepción	5
230	Concepción	68
231	Concordia	5
232	Concordia	47
233	Condoto	27
234	Confines	68
235	Consaca	52
236	Contadero	52
237	Contratación	68
238	Convención	54
239	Copacabana	5
240	Coper	15
241	Cordobá	63
242	Corinto	19
243	Coromoro	68
244	Corozal	70
245	Corrales	15
246	Cota	25
247	Cotorra	23
248	Covarachía	15
249	Coveñas	70
250	Coyaima	73
251	Cravo Norte	81
252	Cuaspud (Carlosama)	52
253	Cubarral	50
254	Cubará	15
255	Cucaita	15
256	Cucunubá	25
257	Cucutilla	54
258	Cuitiva	15
259	Cumaral	50
260	Cumaribo	99
261	Cumbal	52
262	Cumbitara	52
263	Cunday	73
264	Curillo	18
265	Curití	68
266	Curumaní	20
267	Cáceres	5
268	Cáchira	54
269	Cácota	54
270	Cáqueza	25
271	Cértegui	27
272	Cómbita	15
273	Córdoba	13
274	Córdoba	52
275	Cúcuta	54
276	Dabeiba	5
277	Dagua	76
278	Dibulla	44
279	Distracción	44
280	Dolores	73
281	Don Matías	5
282	Dos Quebradas	66
283	Duitama	15
284	Durania	54
285	Ebéjico	5
286	El Bagre	5
287	El Banco	47
288	El Cairo	76
289	El Calvario	50
290	El Carmen	54
291	El Carmen	68
292	El Carmen de Atrato	27
293	El Carmen de Bolívar	13
294	El Castillo	50
295	El Cerrito	76
296	El Charco	52
297	El Cocuy	15
298	El Colegio	25
299	El Copey	20
300	El Doncello	18
301	El Dorado	50
302	El Dovio	76
303	El Espino	15
304	El Guacamayo	68
305	El Guamo	13
306	El Molino	44
307	El Paso	20
308	El Paujil	18
309	El Peñol	52
310	El Peñon	13
311	El Peñon	68
312	El Peñón	25
313	El Piñon	47
314	El Playón	68
315	El Retorno	95
316	El Retén	47
317	El Roble	70
318	El Rosal	25
319	El Rosario	52
320	El Tablón de Gómez	52
321	El Tambo	19
322	El Tambo	52
323	El Tarra	54
324	El Zulia	54
325	El Águila	76
326	Elías	41
327	Encino	68
328	Enciso	68
329	Entrerríos	5
330	Envigado	5
331	Espinal	73
332	Facatativá	25
333	Falan	73
334	Filadelfia	17
335	Filandia	63
336	Firavitoba	15
337	Flandes	73
338	Florencia	18
339	Florencia	19
340	Floresta	15
341	Florida	76
342	Floridablanca	68
343	Florián	68
344	Fonseca	44
345	Fortúl	81
346	Fosca	25
347	Francisco Pizarro	52
348	Fredonia	5
349	Fresno	73
350	Frontino	5
351	Fuente de Oro	50
352	Fundación	47
353	Funes	52
354	Funza	25
355	Fusagasugá	25
356	Fómeque	25
357	Fúquene	25
358	Gachalá	25
359	Gachancipá	25
360	Gachantivá	15
361	Gachetá	25
362	Galapa	8
363	Galeras (Nueva Granada)	70
364	Galán	68
365	Gama	25
366	Gamarra	20
367	Garagoa	15
368	Garzón	41
369	Gigante	41
370	Ginebra	76
371	Giraldo	5
372	Girardot	25
373	Girardota	5
374	Girón	68
375	Gonzalez	20
376	Gramalote	54
377	Granada	5
378	Granada	25
379	Granada	50
380	Guaca	68
381	Guacamayas	15
382	Guacarí	76
383	Guachavés	52
384	Guachené	19
385	Guachetá	25
386	Guachucal	52
387	Guadalupe	5
388	Guadalupe	41
389	Guadalupe	68
390	Guaduas	25
391	Guaitarilla	52
392	Gualmatán	52
393	Guamal	47
394	Guamal	50
395	Guamo	73
396	Guapota	68
397	Guapí	19
398	Guaranda	70
399	Guarne	5
400	Guasca	25
401	Guatapé	5
402	Guataquí	25
403	Guatavita	25
404	Guateque	15
405	Guavatá	68
406	Guayabal de Siquima	25
407	Guayabetal	25
408	Guayatá	15
409	Guepsa	68
410	Guicán	15
411	Gutiérrez	25
412	Guática	66
413	Gámbita	68
414	Gámeza	15
415	Génova	63
416	Gómez Plata	5
417	Hacarí	54
418	Hatillo de Loba	13
419	Hato	68
420	Hato Corozal	85
421	Hatonuevo	44
422	Heliconia	5
423	Herrán	54
424	Herveo	73
425	Hispania	5
426	Hobo	41
427	Honda	73
428	Ibagué	73
429	Icononzo	73
430	Iles	52
431	Imúes	52
432	Inzá	19
433	Inírida	94
434	Ipiales	52
435	Isnos	41
436	Istmina	27
437	Itagüí	5
438	Ituango	5
439	Izá	15
440	Jambaló	19
441	Jamundí	76
442	Jardín	5
443	Jenesano	15
444	Jericó	5
445	Jericó	15
446	Jerusalén	25
447	Jesús María	68
448	Jordán	68
449	Juan de Acosta	8
450	Junín	25
451	Juradó	27
452	La Apartada y La Frontera	23
453	La Argentina	41
454	La Belleza	68
455	La Calera	25
456	La Capilla	15
457	La Ceja	5
458	La Celia	66
459	La Cruz	52
460	La Cumbre	76
461	La Dorada	17
462	La Esperanza	54
463	La Estrella	5
464	La Florida	52
465	La Gloria	20
466	La Jagua de Ibirico	20
467	La Jagua del Pilar	44
468	La Llanada	52
469	La Macarena	50
470	La Merced	17
471	La Mesa	25
472	La Montañita	18
473	La Palma	25
474	La Paz	68
475	La Paz (Robles)	20
476	La Peña	25
477	La Pintada	5
478	La Plata	41
479	La Playa	54
480	La Primavera	99
481	La Salina	85
482	La Sierra	19
483	La Tebaida	63
484	La Tola	52
485	La Unión	5
486	La Unión	52
487	La Unión	70
488	La Unión	76
489	La Uvita	15
490	La Vega	19
491	La Vega	25
492	La Victoria	15
493	La Victoria	17
494	La Victoria	76
495	La Virginia	66
496	Labateca	54
497	Labranzagrande	15
498	Landázuri	68
499	Lebrija	68
500	Leiva	52
501	Lejanías	50
502	Lenguazaque	25
503	Leticia	91
504	Liborina	5
505	Linares	52
506	Lloró	27
507	Lorica	23
508	Los Córdobas	23
509	Los Palmitos	70
510	Los Patios	54
511	Los Santos	68
512	Lourdes	54
513	Luruaco	8
514	Lérida	73
515	Líbano	73
516	López (Micay)	19
517	Macanal	15
518	Macaravita	68
519	Maceo	5
520	Machetá	25
521	Madrid	25
522	Magangué	13
523	Magüi (Payán)	52
524	Mahates	13
525	Maicao	44
526	Majagual	70
527	Malambo	8
528	Mallama (Piedrancha)	52
529	Manatí	8
530	Manaure	44
531	Manaure Balcón del Cesar	20
532	Manizales	17
533	Manta	25
534	Manzanares	17
535	Maní	85
536	Mapiripan	50
537	Margarita	13
538	Marinilla	5
539	Maripí	15
540	Mariquita	73
541	Marmato	17
542	Marquetalia	17
543	Marsella	66
544	Marulanda	17
545	María la Baja	13
546	Matanza	68
547	Medellín	5
548	Medina	25
549	Medio Atrato	27
550	Medio Baudó	27
551	Medio San Juan (ANDAGOYA)	27
552	Melgar	73
553	Mercaderes	19
554	Mesetas	50
555	Milán	18
556	Miraflores	15
557	Miraflores	95
558	Miranda	19
559	Mistrató	66
560	Mitú	97
561	Mocoa	86
562	Mogotes	68
563	Molagavita	68
564	Momil	23
565	Mompós	13
566	Mongua	15
567	Monguí	15
568	Moniquirá	15
569	Montebello	5
570	Montecristo	13
571	Montelíbano	23
572	Montenegro	63
573	Monteria	23
574	Monterrey	85
575	Morales	13
576	Morales	19
577	Morelia	18
578	Morroa	70
579	Mosquera	25
580	Mosquera	52
581	Motavita	15
582	Moñitos	23
583	Murillo	73
584	Murindó	5
585	Mutatá	5
586	Mutiscua	54
587	Muzo	15
588	Málaga	68
589	Nariño	5
590	Nariño	25
591	Nariño	52
592	Natagaima	73
593	Nechí	5
594	Necoclí	5
595	Neira	17
596	Neiva	41
597	Nemocón	25
598	Nilo	25
599	Nimaima	25
600	Nobsa	15
601	Nocaima	25
602	Norcasia	17
603	Norosí	13
604	Novita	27
605	Nueva Granada	47
606	Nuevo Colón	15
607	Nunchía	85
608	Nuquí	27
609	Nátaga	41
610	Obando	76
611	Ocamonte	68
612	Ocaña	54
613	Oiba	68
614	Oicatá	15
615	Olaya	5
616	Olaya Herrera	52
617	Onzaga	68
618	Oporapa	41
619	Orito	86
620	Orocué	85
621	Ortega	73
622	Ospina	52
623	Otanche	15
624	Ovejas	70
625	Pachavita	15
626	Pacho	25
627	Padilla	19
628	Paicol	41
629	Pailitas	20
630	Paime	25
631	Paipa	15
632	Pajarito	15
633	Palermo	41
634	Palestina	17
635	Palestina	41
636	Palmar	68
637	Palmar de Varela	8
638	Palmas del Socorro	68
639	Palmira	76
640	Palmito	70
641	Palocabildo	73
642	Pamplona	54
643	Pamplonita	54
644	Pandi	25
645	Panqueba	15
646	Paratebueno	25
647	Pasca	25
648	Patía (El Bordo)	19
649	Pauna	15
650	Paya	15
651	Paz de Ariporo	85
652	Paz de Río	15
653	Pedraza	47
654	Pelaya	20
655	Pensilvania	17
656	Peque	5
657	Pereira	66
658	Pesca	15
659	Peñol	5
660	Piamonte	19
661	Pie de Cuesta	68
662	Piedras	73
663	Piendamó	19
664	Pijao	63
665	Pijiño	47
666	Pinchote	68
667	Pinillos	13
668	Piojo	8
669	Pisva	15
670	Pital	41
671	Pitalito	41
672	Pivijay	47
673	Planadas	73
674	Planeta Rica	23
675	Plato	47
676	Policarpa	52
677	Polonuevo	8
678	Ponedera	8
679	Popayán	19
680	Pore	85
681	Potosí	52
682	Pradera	76
683	Prado	73
684	Providencia	52
685	Providencia	88
686	Pueblo Bello	20
687	Pueblo Nuevo	23
688	Pueblo Rico	66
689	Pueblorrico	5
690	Puebloviejo	47
691	Puente Nacional	68
692	Puerres	52
693	Puerto Asís	86
694	Puerto Berrío	5
695	Puerto Boyacá	15
696	Puerto Caicedo	86
697	Puerto Carreño	99
698	Puerto Colombia	8
699	Puerto Concordia	50
700	Puerto Escondido	23
701	Puerto Gaitán	50
702	Puerto Guzmán	86
703	Puerto Leguízamo	86
704	Puerto Libertador	23
705	Puerto Lleras	50
706	Puerto López	50
707	Puerto Nare	5
708	Puerto Nariño	91
709	Puerto Parra	68
710	Puerto Rico	18
711	Puerto Rico	50
712	Puerto Rondón	81
713	Puerto Salgar	25
714	Puerto Santander	54
715	Puerto Tejada	19
716	Puerto Triunfo	5
717	Puerto Wilches	68
718	Pulí	25
719	Pupiales	52
720	Puracé (Coconuco)	19
721	Purificación	73
722	Purísima	23
723	Pácora	17
724	Páez	15
725	Páez (Belalcazar)	19
726	Páramo	68
727	Quebradanegra	25
728	Quetame	25
729	Quibdó	27
730	Quimbaya	63
731	Quinchía	66
732	Quipama	15
733	Quipile	25
734	Ragonvalia	54
735	Ramiriquí	15
736	Recetor	85
737	Regidor	13
738	Remedios	5
739	Remolino	47
740	Repelón	8
741	Restrepo	50
742	Restrepo	76
743	Retiro	5
744	Ricaurte	25
745	Ricaurte	52
746	Rio Negro	68
747	Rioblanco	73
748	Riofrío	76
749	Riohacha	44
750	Risaralda	17
751	Rivera	41
752	Roberto Payán (San José)	52
753	Roldanillo	76
754	Roncesvalles	73
755	Rondón	15
756	Rosas	19
757	Rovira	73
758	Ráquira	15
759	Río Iró	27
760	Río Quito	27
761	Río Sucio	17
762	Río Viejo	13
763	Río de oro	20
764	Ríonegro	5
765	Ríosucio	27
766	Sabana de Torres	68
767	Sabanagrande	8
768	Sabanalarga	5
769	Sabanalarga	8
770	Sabanalarga	85
771	Sabanas de San Angel (SAN ANGEL)	47
772	Sabaneta	5
773	Saboyá	15
774	Sahagún	23
775	Saladoblanco	41
776	Salamina	17
777	Salamina	47
778	Salazar	54
779	Saldaña	73
780	Salento	63
781	Salgar	5
782	Samacá	15
783	Samaniego	52
784	Samaná	17
785	Sampués	70
786	San Agustín	41
787	San Alberto	20
788	San Andrés	68
789	San Andrés Sotavento	23
790	San Andrés de Cuerquía	5
791	San Antero	23
792	San Antonio	73
793	San Antonio de Tequendama	25
794	San Benito	68
795	San Benito Abad	70
796	San Bernardo	25
797	San Bernardo	52
798	San Bernardo del Viento	23
799	San Calixto	54
800	San Carlos	5
801	San Carlos	23
802	San Carlos de Guaroa	50
803	San Cayetano	25
804	San Cayetano	54
805	San Cristobal	13
806	San Diego	20
807	San Eduardo	15
808	San Estanislao	13
809	San Fernando	13
810	San Francisco	5
811	San Francisco	25
812	San Francisco	86
813	San Gíl	68
814	San Jacinto	13
815	San Jacinto del Cauca	13
816	San Jerónimo	5
817	San Joaquín	68
818	San José	17
819	San José de Miranda	68
820	San José de Montaña	5
821	San José de Pare	15
822	San José de Uré	23
823	San José del Fragua	18
824	San José del Guaviare	95
825	San José del Palmar	27
826	San Juan de Arama	50
827	San Juan de Betulia	70
828	San Juan de Nepomuceno	13
829	San Juan de Pasto	52
830	San Juan de Río Seco	25
831	San Juan de Urabá	5
832	San Juan del Cesar	44
833	San Juanito	50
834	San Lorenzo	52
835	San Luis	73
836	San Luís	5
837	San Luís de Gaceno	15
838	San Luís de Palenque	85
839	San Marcos	70
840	San Martín	20
841	San Martín	50
842	San Martín de Loba	13
843	San Mateo	15
844	San Miguel	68
845	San Miguel	86
846	San Miguel de Sema	15
847	San Onofre	70
848	San Pablo	13
849	San Pablo	52
850	San Pablo de Borbur	15
851	San Pedro	5
852	San Pedro	70
853	San Pedro	76
854	San Pedro de Cartago	52
855	San Pedro de Urabá	5
856	San Pelayo	23
857	San Rafael	5
858	San Roque	5
859	San Sebastián	19
860	San Sebastián de Buenavista	47
861	San Vicente	5
862	San Vicente del Caguán	18
863	San Vicente del Chucurí	68
864	San Zenón	47
865	Sandoná	52
866	Santa Ana	47
867	Santa Bárbara	5
868	Santa Bárbara	68
869	Santa Bárbara (Iscuandé)	52
870	Santa Bárbara de Pinto	47
871	Santa Catalina	13
872	Santa Fé de Antioquia	5
873	Santa Genoveva de Docorodó	27
874	Santa Helena del Opón	68
875	Santa Isabel	73
876	Santa Lucía	8
877	Santa Marta	47
878	Santa María	15
879	Santa María	41
880	Santa Rosa	13
881	Santa Rosa	19
882	Santa Rosa de Cabal	66
883	Santa Rosa de Osos	5
884	Santa Rosa de Viterbo	15
885	Santa Rosa del Sur	13
886	Santa Rosalía	99
887	Santa Sofía	15
888	Santana	15
889	Santander de Quilichao	19
890	Santiago	54
891	Santiago	86
892	Santo Domingo	5
893	Santo Tomás	8
894	Santuario	5
895	Santuario	66
896	Sapuyes	52
897	Saravena	81
898	Sardinata	54
899	Sasaima	25
900	Sativanorte	15
901	Sativasur	15
902	Segovia	5
903	Sesquilé	25
904	Sevilla	76
905	Siachoque	15
906	Sibaté	25
907	Sibundoy	86
908	Silos	54
909	Silvania	25
910	Silvia	19
911	Simacota	68
912	Simijaca	25
913	Simití	13
914	Sincelejo	70
915	Sincé	70
916	Sipí	27
917	Sitionuevo	47
918	Soacha	25
919	Soatá	15
920	Socha	15
921	Socorro	68
922	Socotá	15
923	Sogamoso	15
924	Solano	18
925	Soledad	8
926	Solita	18
927	Somondoco	15
928	Sonsón	5
929	Sopetrán	5
930	Soplaviento	13
931	Sopó	25
932	Sora	15
933	Soracá	15
934	Sotaquirá	15
935	Sotara (Paispamba)	19
936	Sotomayor (Los Andes)	52
937	Suaita	68
938	Suan	8
939	Suaza	41
940	Subachoque	25
941	Sucre	19
942	Sucre	68
943	Sucre	70
944	Suesca	25
945	Supatá	25
946	Supía	17
947	Suratá	68
948	Susa	25
949	Susacón	15
950	Sutamarchán	15
951	Sutatausa	25
952	Sutatenza	15
953	Suárez	19
954	Suárez	73
955	Sácama	85
956	Sáchica	15
957	Tabio	25
958	Tadó	27
959	Talaigua Nuevo	13
960	Tamalameque	20
961	Tame	81
962	Taminango	52
963	Tangua	52
964	Taraira	97
965	Tarazá	5
966	Tarqui	41
967	Tarso	5
968	Tasco	15
969	Tauramena	85
970	Tausa	25
971	Tello	41
972	Tena	25
973	Tenerife	47
974	Tenjo	25
975	Tenza	15
976	Teorama	54
977	Teruel	41
978	Tesalia	41
979	Tibacuy	25
980	Tibaná	15
981	Tibasosa	15
982	Tibirita	25
983	Tibú	54
984	Tierralta	23
985	Timaná	41
986	Timbiquí	19
987	Timbío	19
988	Tinjacá	15
989	Tipacoque	15
990	Tiquisio (Puerto Rico)	13
991	Titiribí	5
992	Toca	15
993	Tocaima	25
994	Tocancipá	25
995	Toguí	15
996	Toledo	5
997	Toledo	54
998	Tolú	70
999	Tolú Viejo	70
1000	Tona	68
1001	Topagá	15
1002	Topaipí	25
1003	Toribío	19
1004	Toro	76
1005	Tota	15
1006	Totoró	19
1007	Trinidad	85
1008	Trujillo	76
1009	Tubará	8
1010	Tuchín	23
1011	Tulúa	76
1012	Tumaco	52
1013	Tunja	15
1014	Tunungua	15
1015	Turbaco	13
1016	Turbaná	13
1017	Turbo	5
1018	Turmequé	15
1019	Tuta	15
1020	Tutasá	15
1021	Támara	85
1022	Támesis	5
1023	Túquerres	52
1024	Ubalá	25
1025	Ubaque	25
1026	Ubaté	25
1027	Ulloa	76
1028	Une	25
1029	Unguía	27
1030	Unión Panamericana (ÁNIMAS)	27
1031	Uramita	5
1032	Uribe	50
1033	Uribia	44
1034	Urrao	5
1035	Urumita	44
1036	Usiacuri	8
1037	Valdivia	5
1038	Valencia	23
1039	Valle de San José	68
1040	Valle de San Juan	73
1041	Valle del Guamuez	86
1042	Valledupar	20
1043	Valparaiso	5
1044	Valparaiso	18
1045	Vegachí	5
1046	Venadillo	73
1047	Venecia	5
1048	Venecia (Ospina Pérez)	25
1049	Ventaquemada	15
1050	Vergara	25
1051	Versalles	76
1052	Vetas	68
1053	Viani	25
1054	Vigía del Fuerte	5
1055	Vijes	76
1056	Villa Caro	54
1057	Villa Rica	19
1058	Villa de Leiva	15
1059	Villa del Rosario	54
1060	Villagarzón	86
1061	Villagómez	25
1062	Villahermosa	73
1063	Villamaría	17
1064	Villanueva	13
1065	Villanueva	44
1066	Villanueva	68
1067	Villanueva	85
1068	Villapinzón	25
1069	Villarrica	73
1070	Villavicencio	50
1071	Villavieja	41
1072	Villeta	25
1073	Viotá	25
1074	Viracachá	15
1075	Vista Hermosa	50
1076	Viterbo	17
1077	Vélez	68
1078	Yacopí	25
1079	Yacuanquer	52
1080	Yaguará	41
1081	Yalí	5
1082	Yarumal	5
1083	Yolombó	5
1084	Yondó (Casabe)	5
1085	Yopal	85
1086	Yotoco	76
1087	Yumbo	76
1088	Zambrano	13
1089	Zapatoca	68
1090	Zapayán (PUNTA DE PIEDRAS)	47
1091	Zaragoza	5
1092	Zarzal	76
1093	Zetaquirá	15
1094	Zipacón	25
1095	Zipaquirá	25
1096	Zona Bananera (PRADO - SEVILLA)	47
1097	Ábrego	54
1098	Íquira	41
1099	Úmbita	15
1100	Útica	25
\.


--
-- TOC entry 3362 (class 0 OID 52954)
-- Dependencies: 244
-- Data for Name: nombre_cultivo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nombre_cultivo (cod_ncu, des_ncu) FROM stdin;
\.


--
-- TOC entry 3364 (class 0 OID 52959)
-- Dependencies: 246
-- Data for Name: otros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.otros (cod_otr, cod_ins, det_otr) FROM stdin;
\.


--
-- TOC entry 3366 (class 0 OID 52964)
-- Dependencies: 248
-- Data for Name: plagas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.plagas (cod_afe, cod_plg, tip_plg) FROM stdin;
\.


--
-- TOC entry 3367 (class 0 OID 52967)
-- Dependencies: 249
-- Data for Name: planificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.planificacion (cod_pla, fec_pla, epo_pla) FROM stdin;
\.


--
-- TOC entry 3368 (class 0 OID 52970)
-- Dependencies: 250
-- Data for Name: pre_sto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pre_sto (fec_cin, cod_sto, pre_sto, cod_pre) FROM stdin;
\.


--
-- TOC entry 3370 (class 0 OID 52975)
-- Dependencies: 252
-- Data for Name: produccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produccion (cod_pro, cod_cul, ide_ter) FROM stdin;
\.


--
-- TOC entry 3372 (class 0 OID 52980)
-- Dependencies: 254
-- Data for Name: proveedor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.proveedor (cod_pro, ide_ter) FROM stdin;
\.


--
-- TOC entry 3374 (class 0 OID 52985)
-- Dependencies: 256
-- Data for Name: registrar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.registrar (cod_com, cod_sto) FROM stdin;
\.


--
-- TOC entry 3375 (class 0 OID 52988)
-- Dependencies: 257
-- Data for Name: semillas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.semillas (cod_sem, cod_ins, cod_tsa, det_sem) FROM stdin;
\.


--
-- TOC entry 3377 (class 0 OID 52993)
-- Dependencies: 259
-- Data for Name: semillero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.semillero (cod_smr, cod_ins, cod_tso, det_smr) FROM stdin;
\.


--
-- TOC entry 3379 (class 0 OID 52998)
-- Dependencies: 261
-- Data for Name: socio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.socio (cod_soc, ide_ter) FROM stdin;
\.


--
-- TOC entry 3381 (class 0 OID 53003)
-- Dependencies: 263
-- Data for Name: stock; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.stock (cod_sto, can_sto, cod_ins) FROM stdin;
\.


--
-- TOC entry 3383 (class 0 OID 53008)
-- Dependencies: 265
-- Data for Name: tarea; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tarea (cod_tar, fin_tar, ffi_tar, val_tar, des_tar) FROM stdin;
\.


--
-- TOC entry 3385 (class 0 OID 53013)
-- Dependencies: 267
-- Data for Name: tel_tercero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tel_tercero (ide_ter, tel_ter) FROM stdin;
\.


--
-- TOC entry 3386 (class 0 OID 53016)
-- Dependencies: 268
-- Data for Name: terceros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.terceros (ide_ter, pno_ter, sno_ter, pap_ter, sap_ter) FROM stdin;
\.


--
-- TOC entry 3387 (class 0 OID 53019)
-- Dependencies: 269
-- Data for Name: tipo_agroquimico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_agroquimico (cod_tag, det_tag) FROM stdin;
1	Insecticida
2	Fungicida
3	Bactericida
4	Herbicida
5	Nematicida
6	Pesticida
\.


--
-- TOC entry 3388 (class 0 OID 53022)
-- Dependencies: 270
-- Data for Name: tipo_de_produccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_de_produccion (cod_tpr, des_tpr, cod_unm) FROM stdin;
2	1-Parejo	11
5	3-Grueso	12
4	1-Picado	12
1	1-Grueso	11
3	1-Delgado	11
6	1-Picado	11
\.


--
-- TOC entry 3390 (class 0 OID 53027)
-- Dependencies: 272
-- Data for Name: tipo_semilla; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_semilla (cod_tsa, det_tsa) FROM stdin;
1	Tomate de árbol
2	Tomate de guiso
\.


--
-- TOC entry 3392 (class 0 OID 53032)
-- Dependencies: 274
-- Data for Name: tipo_semillero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_semillero (cod_tso, det_tso) FROM stdin;
1	Plántula 
\.


--
-- TOC entry 3394 (class 0 OID 53037)
-- Dependencies: 276
-- Data for Name: tipo_unidad_medida; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_unidad_medida (cod_tum, des_tum) FROM stdin;
1	Superfie
3	Capacidad
4	Masa
6	Volumen
7	Cantidad
2	Longitud
\.


--
-- TOC entry 3396 (class 0 OID 53042)
-- Dependencies: 278
-- Data for Name: toxicidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.toxicidad (cod_tox, det_tox, col_tox) FROM stdin;
1	Ia	Rojo
2	Ib	Rojo
3	II	Amarillo
4	III	Azul
5	IV	Verde
\.


--
-- TOC entry 3397 (class 0 OID 53045)
-- Dependencies: 279
-- Data for Name: trabajador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.trabajador (cod_tra, ide_ter) FROM stdin;
\.


--
-- TOC entry 3399 (class 0 OID 53050)
-- Dependencies: 281
-- Data for Name: unidad_de_medida; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.unidad_de_medida (cod_unm, des_unm, cod_tum, equ_med) FROM stdin;
2	Metros Cuadrados - M²	1	1
3	Kilometros Cuadrados - K²	1	1000
5	Kilogramo - Kg	4	2
6	Unidad - Uni	7	1
1	Fanegadas - Fanegadas	1	6400
7	Litros - Ls	3	1
9	Centilitro - Cl	3	100
10	Decilitro - Dl	3	10
8	Mililitros - Ml	3	1000
4	Gramos - Gr	4	454
11	Canastilla -Canastilla	7	1
12	Bulto - Bulto	7	1
\.


--
-- TOC entry 3401 (class 0 OID 53055)
-- Dependencies: 283
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (id_usu, usu_usu, pas_usu) FROM stdin;
1	jcho1214	99011413702
2	ygonzalez95	yulianalok
\.


--
-- TOC entry 3403 (class 0 OID 53060)
-- Dependencies: 285
-- Data for Name: utilizar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utilizar (cod_sto, cod_tar, cin_tar, pin_tar, cod_uti) FROM stdin;
\.


--
-- TOC entry 3442 (class 0 OID 0)
-- Dependencies: 203
-- Name: cliente_cod_cli_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cliente_cod_cli_seq', 9, true);


--
-- TOC entry 3443 (class 0 OID 0)
-- Dependencies: 206
-- Name: compras_cod_com_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.compras_cod_com_seq', 1, false);


--
-- TOC entry 3444 (class 0 OID 0)
-- Dependencies: 208
-- Name: comun_cod_cun_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.comun_cod_cun_seq', 42, true);


--
-- TOC entry 3445 (class 0 OID 0)
-- Dependencies: 210
-- Name: contratos_cod_cot_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contratos_cod_cot_seq', 39, true);


--
-- TOC entry 3446 (class 0 OID 0)
-- Dependencies: 212
-- Name: convenio_cod_con_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.convenio_cod_con_seq', 114, true);


--
-- TOC entry 3447 (class 0 OID 0)
-- Dependencies: 214
-- Name: cultivos_cod_cul_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cultivos_cod_cul_seq', 68, true);


--
-- TOC entry 3448 (class 0 OID 0)
-- Dependencies: 216
-- Name: cultural_cod_cut_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cultural_cod_cut_seq', 18, true);


--
-- TOC entry 3449 (class 0 OID 0)
-- Dependencies: 220
-- Name: dueño_cod_due_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."dueño_cod_due_seq"', 50, true);


--
-- TOC entry 3450 (class 0 OID 0)
-- Dependencies: 229
-- Name: fincas_cnt_fin_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fincas_cnt_fin_seq', 51, true);


--
-- TOC entry 3451 (class 0 OID 0)
-- Dependencies: 231
-- Name: fitosanitaria_cod_fit_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fitosanitaria_cod_fit_seq', 12, true);


--
-- TOC entry 3452 (class 0 OID 0)
-- Dependencies: 234
-- Name: insumos_cod_ins_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.insumos_cod_ins_seq', 72, true);


--
-- TOC entry 3453 (class 0 OID 0)
-- Dependencies: 236
-- Name: jornales_cod_jor_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jornales_cod_jor_seq', 63, true);


--
-- TOC entry 3454 (class 0 OID 0)
-- Dependencies: 238
-- Name: labores_cod_lab_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.labores_cod_lab_seq', 19, true);


--
-- TOC entry 3455 (class 0 OID 0)
-- Dependencies: 240
-- Name: lotes_cod_lot_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lotes_cod_lot_seq', 82, true);


--
-- TOC entry 3456 (class 0 OID 0)
-- Dependencies: 245
-- Name: nombre_cultivo_cod_ncu_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nombre_cultivo_cod_ncu_seq', 33, true);


--
-- TOC entry 3457 (class 0 OID 0)
-- Dependencies: 247
-- Name: otros_cod_otr_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.otros_cod_otr_seq', 17, true);


--
-- TOC entry 3458 (class 0 OID 0)
-- Dependencies: 251
-- Name: pre_sto_cod_pre_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pre_sto_cod_pre_seq', 96, true);


--
-- TOC entry 3459 (class 0 OID 0)
-- Dependencies: 253
-- Name: produccion_cod_pro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produccion_cod_pro_seq', 74, true);


--
-- TOC entry 3460 (class 0 OID 0)
-- Dependencies: 255
-- Name: proveedor_cod_pro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.proveedor_cod_pro_seq', 16, true);


--
-- TOC entry 3461 (class 0 OID 0)
-- Dependencies: 258
-- Name: semillas_cod_sem_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.semillas_cod_sem_seq', 20, true);


--
-- TOC entry 3462 (class 0 OID 0)
-- Dependencies: 260
-- Name: semillero_cod_smr_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.semillero_cod_smr_seq', 12, true);


--
-- TOC entry 3463 (class 0 OID 0)
-- Dependencies: 262
-- Name: socio_cod_soc_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.socio_cod_soc_seq', 17, true);


--
-- TOC entry 3464 (class 0 OID 0)
-- Dependencies: 264
-- Name: stock_cod_sto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.stock_cod_sto_seq', 299, true);


--
-- TOC entry 3465 (class 0 OID 0)
-- Dependencies: 266
-- Name: tarea_cod_tar_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tarea_cod_tar_seq', 79, true);


--
-- TOC entry 3466 (class 0 OID 0)
-- Dependencies: 271
-- Name: tipo_de_produccion_cod_tpr_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_de_produccion_cod_tpr_seq', 6, true);


--
-- TOC entry 3467 (class 0 OID 0)
-- Dependencies: 273
-- Name: tipo_semilla_cod_tsa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_semilla_cod_tsa_seq', 1, true);


--
-- TOC entry 3468 (class 0 OID 0)
-- Dependencies: 275
-- Name: tipo_semillero_cod_tso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_semillero_cod_tso_seq', 2, true);


--
-- TOC entry 3469 (class 0 OID 0)
-- Dependencies: 277
-- Name: tipo_unidad_medida_cod_tum_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_unidad_medida_cod_tum_seq', 1, false);


--
-- TOC entry 3470 (class 0 OID 0)
-- Dependencies: 280
-- Name: trabajador_cod_tra_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.trabajador_cod_tra_seq', 26, true);


--
-- TOC entry 3471 (class 0 OID 0)
-- Dependencies: 282
-- Name: unidad_de_medida_cod_unm_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.unidad_de_medida_cod_unm_seq', 7, true);


--
-- TOC entry 3472 (class 0 OID 0)
-- Dependencies: 284
-- Name: usuario_id_usu_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_usu_seq', 2, true);


--
-- TOC entry 3473 (class 0 OID 0)
-- Dependencies: 286
-- Name: utilizar_cod_uti_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utilizar_cod_uti_seq', 70, true);


--
-- TOC entry 3015 (class 2606 OID 53098)
-- Name: act_con acordar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_con
    ADD CONSTRAINT acordar_pkey PRIMARY KEY (cod_con, ide_ter);


--
-- TOC entry 3017 (class 2606 OID 53100)
-- Name: act_cul actuar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_cul
    ADD CONSTRAINT actuar_pkey PRIMARY KEY (ide_ter, cod_cul);


--
-- TOC entry 3019 (class 2606 OID 53102)
-- Name: afeccion afeccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.afeccion
    ADD CONSTRAINT afeccion_pkey PRIMARY KEY (cod_afe);


--
-- TOC entry 3021 (class 2606 OID 53104)
-- Name: agr_x_eag agr_x_eag_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agr_x_eag
    ADD CONSTRAINT agr_x_eag_pkey PRIMARY KEY (cod_eag, cod_agr);


--
-- TOC entry 3023 (class 2606 OID 53106)
-- Name: agr_x_mol agr_x_mol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agr_x_mol
    ADD CONSTRAINT agr_x_mol_pkey PRIMARY KEY (cod_agr, cod_mol);


--
-- TOC entry 3025 (class 2606 OID 53108)
-- Name: agroquimicos agroquimicos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT agroquimicos_pkey PRIMARY KEY (cod_agr);


--
-- TOC entry 3027 (class 2606 OID 53110)
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (cod_cli);


--
-- TOC entry 3029 (class 2606 OID 53112)
-- Name: comprar comprar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comprar
    ADD CONSTRAINT comprar_pkey PRIMARY KEY (ide_ter, cod_com);


--
-- TOC entry 3031 (class 2606 OID 53114)
-- Name: compras compras_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compras
    ADD CONSTRAINT compras_pkey PRIMARY KEY (cod_com);


--
-- TOC entry 3033 (class 2606 OID 53116)
-- Name: comun comun_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comun
    ADD CONSTRAINT comun_pkey PRIMARY KEY (cod_cun);


--
-- TOC entry 3035 (class 2606 OID 53118)
-- Name: contratos contratos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contratos
    ADD CONSTRAINT contratos_pkey PRIMARY KEY (cod_cot);


--
-- TOC entry 3037 (class 2606 OID 53120)
-- Name: convenio convenio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.convenio
    ADD CONSTRAINT convenio_pkey PRIMARY KEY (cod_con);


--
-- TOC entry 3039 (class 2606 OID 53122)
-- Name: cultivos cultivos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultivos
    ADD CONSTRAINT cultivos_pkey PRIMARY KEY (cod_cul);


--
-- TOC entry 3041 (class 2606 OID 53124)
-- Name: cultural cultural_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultural
    ADD CONSTRAINT cultural_pkey PRIMARY KEY (cod_cut);


--
-- TOC entry 3043 (class 2606 OID 53126)
-- Name: departamento departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (cod_dep);


--
-- TOC entry 3045 (class 2606 OID 53128)
-- Name: dueño dueño_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."dueño"
    ADD CONSTRAINT "dueño_pkey" PRIMARY KEY (cod_due);


--
-- TOC entry 3047 (class 2606 OID 53130)
-- Name: ejecutar ejecutar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ejecutar
    ADD CONSTRAINT ejecutar_pkey PRIMARY KEY (cod_con, cod_cul);


--
-- TOC entry 3049 (class 2606 OID 53132)
-- Name: email_tercero email_tercero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_tercero
    ADD CONSTRAINT email_tercero_pkey PRIMARY KEY (ide_ter, ema_ter);


--
-- TOC entry 3051 (class 2606 OID 53134)
-- Name: enfermedades enfermedades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enfermedades
    ADD CONSTRAINT enfermedades_pkey PRIMARY KEY (cod_afe, cod_enf);


--
-- TOC entry 3053 (class 2606 OID 53136)
-- Name: estado_agroquimico estado_agroquimico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estado_agroquimico
    ADD CONSTRAINT estado_agroquimico_pkey PRIMARY KEY (cod_eag);


--
-- TOC entry 3055 (class 2606 OID 53138)
-- Name: eta_x_afe eta_x_afe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eta_x_afe
    ADD CONSTRAINT eta_x_afe_pkey PRIMARY KEY (cod_afe, cod_eta);


--
-- TOC entry 3057 (class 2606 OID 53140)
-- Name: etapas_crecimiento etapas_crecimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas_crecimiento
    ADD CONSTRAINT etapas_crecimiento_pkey PRIMARY KEY (cod_eta);


--
-- TOC entry 3059 (class 2606 OID 53142)
-- Name: fincas fincas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_pkey PRIMARY KEY (cod_fin);


--
-- TOC entry 3061 (class 2606 OID 53144)
-- Name: fitosanitaria fitosanitaria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fitosanitaria
    ADD CONSTRAINT fitosanitaria_pkey PRIMARY KEY (cod_fit);


--
-- TOC entry 3063 (class 2606 OID 53146)
-- Name: gozar gozar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gozar
    ADD CONSTRAINT gozar_pkey PRIMARY KEY (cod_tpr, cod_pro);


--
-- TOC entry 3065 (class 2606 OID 53148)
-- Name: insumos insumos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.insumos
    ADD CONSTRAINT insumos_pkey PRIMARY KEY (cod_ins);


--
-- TOC entry 3067 (class 2606 OID 53150)
-- Name: jornales jornales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jornales
    ADD CONSTRAINT jornales_pkey PRIMARY KEY (cod_jor);


--
-- TOC entry 3069 (class 2606 OID 53152)
-- Name: labores labores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labores
    ADD CONSTRAINT labores_pkey PRIMARY KEY (cod_lab);


--
-- TOC entry 3071 (class 2606 OID 53154)
-- Name: lotes lotes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_pkey PRIMARY KEY (cod_lot);


--
-- TOC entry 3073 (class 2606 OID 53156)
-- Name: mol_x_afe mol_x_afe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT mol_x_afe_pkey PRIMARY KEY (cod_mol, cod_afe, cod_eta);


--
-- TOC entry 3075 (class 2606 OID 53158)
-- Name: moleculas moleculas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.moleculas
    ADD CONSTRAINT moleculas_pkey PRIMARY KEY (cod_mol);


--
-- TOC entry 3077 (class 2606 OID 53160)
-- Name: municipio municipio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (cod_mun);


--
-- TOC entry 3079 (class 2606 OID 53162)
-- Name: nombre_cultivo nombre_cultivo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nombre_cultivo
    ADD CONSTRAINT nombre_cultivo_pkey PRIMARY KEY (cod_ncu);


--
-- TOC entry 3081 (class 2606 OID 53164)
-- Name: otros otros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otros
    ADD CONSTRAINT otros_pkey PRIMARY KEY (cod_otr);


--
-- TOC entry 3083 (class 2606 OID 53166)
-- Name: plagas plagas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plagas
    ADD CONSTRAINT plagas_pkey PRIMARY KEY (cod_afe, cod_plg);


--
-- TOC entry 3085 (class 2606 OID 53168)
-- Name: planificacion planificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.planificacion
    ADD CONSTRAINT planificacion_pkey PRIMARY KEY (cod_pla);


--
-- TOC entry 3087 (class 2606 OID 53170)
-- Name: pre_sto pre_sto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pre_sto
    ADD CONSTRAINT pre_sto_pkey PRIMARY KEY (fec_cin, cod_sto, cod_pre);


--
-- TOC entry 3089 (class 2606 OID 53172)
-- Name: produccion produccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produccion
    ADD CONSTRAINT produccion_pkey PRIMARY KEY (cod_pro);


--
-- TOC entry 3091 (class 2606 OID 53174)
-- Name: proveedor proveedor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (cod_pro);


--
-- TOC entry 3093 (class 2606 OID 53176)
-- Name: registrar registar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registrar
    ADD CONSTRAINT registar_pkey PRIMARY KEY (cod_com, cod_sto);


--
-- TOC entry 3095 (class 2606 OID 53178)
-- Name: semillas semillas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillas
    ADD CONSTRAINT semillas_pkey PRIMARY KEY (cod_sem);


--
-- TOC entry 3097 (class 2606 OID 53180)
-- Name: semillero semillero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillero
    ADD CONSTRAINT semillero_pkey PRIMARY KEY (cod_smr);


--
-- TOC entry 3099 (class 2606 OID 53182)
-- Name: socio socio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.socio
    ADD CONSTRAINT socio_pkey PRIMARY KEY (cod_soc);


--
-- TOC entry 3101 (class 2606 OID 53184)
-- Name: stock stock_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stock
    ADD CONSTRAINT stock_pkey PRIMARY KEY (cod_sto);


--
-- TOC entry 3103 (class 2606 OID 53186)
-- Name: tarea tarea_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarea
    ADD CONSTRAINT tarea_pkey PRIMARY KEY (cod_tar);


--
-- TOC entry 3105 (class 2606 OID 53188)
-- Name: tel_tercero tel_tercero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tel_tercero
    ADD CONSTRAINT tel_tercero_pkey PRIMARY KEY (ide_ter, tel_ter);


--
-- TOC entry 3107 (class 2606 OID 53190)
-- Name: terceros terceros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terceros
    ADD CONSTRAINT terceros_pkey PRIMARY KEY (ide_ter);


--
-- TOC entry 3109 (class 2606 OID 53192)
-- Name: tipo_agroquimico tipo_agroquimico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_agroquimico
    ADD CONSTRAINT tipo_agroquimico_pkey PRIMARY KEY (cod_tag);


--
-- TOC entry 3111 (class 2606 OID 53194)
-- Name: tipo_de_produccion tipo_de_produccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_de_produccion
    ADD CONSTRAINT tipo_de_produccion_pkey PRIMARY KEY (cod_tpr);


--
-- TOC entry 3113 (class 2606 OID 53196)
-- Name: tipo_semilla tipo_semilla_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_semilla
    ADD CONSTRAINT tipo_semilla_pkey PRIMARY KEY (cod_tsa);


--
-- TOC entry 3115 (class 2606 OID 53198)
-- Name: tipo_semillero tipo_semillero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_semillero
    ADD CONSTRAINT tipo_semillero_pkey PRIMARY KEY (cod_tso);


--
-- TOC entry 3117 (class 2606 OID 53200)
-- Name: tipo_unidad_medida tipo_unidad_medida_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_unidad_medida
    ADD CONSTRAINT tipo_unidad_medida_pkey PRIMARY KEY (cod_tum);


--
-- TOC entry 3119 (class 2606 OID 53202)
-- Name: toxicidad toxicidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.toxicidad
    ADD CONSTRAINT toxicidad_pkey PRIMARY KEY (cod_tox);


--
-- TOC entry 3121 (class 2606 OID 53204)
-- Name: trabajador trabajador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trabajador
    ADD CONSTRAINT trabajador_pkey PRIMARY KEY (cod_tra);


--
-- TOC entry 3123 (class 2606 OID 53206)
-- Name: unidad_de_medida unidad_de_medida_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidad_de_medida
    ADD CONSTRAINT unidad_de_medida_pkey PRIMARY KEY (cod_unm);


--
-- TOC entry 3125 (class 2606 OID 53208)
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usu);


--
-- TOC entry 3127 (class 2606 OID 53210)
-- Name: utilizar utilizar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilizar
    ADD CONSTRAINT utilizar_pkey PRIMARY KEY (cod_sto, cod_tar, cod_uti);


--
-- TOC entry 3128 (class 2606 OID 53211)
-- Name: act_con acordar_cod_con_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_con
    ADD CONSTRAINT acordar_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);


--
-- TOC entry 3129 (class 2606 OID 53216)
-- Name: act_con acordar_ide_ter_gkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_con
    ADD CONSTRAINT acordar_ide_ter_gkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3130 (class 2606 OID 53221)
-- Name: act_cul actuar_cod_cul_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_cul
    ADD CONSTRAINT actuar_cod_cul_fkey FOREIGN KEY (cod_cul) REFERENCES public.cultivos(cod_cul);


--
-- TOC entry 3131 (class 2606 OID 53226)
-- Name: act_cul actuar_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_cul
    ADD CONSTRAINT actuar_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3136 (class 2606 OID 53231)
-- Name: agroquimicos agroquimicos_cod_ins_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT agroquimicos_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);


--
-- TOC entry 3139 (class 2606 OID 53236)
-- Name: cliente cliente_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3140 (class 2606 OID 53241)
-- Name: comprar comprar_cod_com_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comprar
    ADD CONSTRAINT comprar_cod_com_fkey FOREIGN KEY (cod_com) REFERENCES public.compras(cod_com);


--
-- TOC entry 3141 (class 2606 OID 53246)
-- Name: comprar comprar_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comprar
    ADD CONSTRAINT comprar_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3142 (class 2606 OID 53251)
-- Name: comun comun_cod_tar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comun
    ADD CONSTRAINT comun_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);


--
-- TOC entry 3143 (class 2606 OID 53256)
-- Name: contratos contratos_cod_con_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contratos
    ADD CONSTRAINT contratos_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);


--
-- TOC entry 3150 (class 2606 OID 53261)
-- Name: efectuar convenio_cod_con_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.efectuar
    ADD CONSTRAINT convenio_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);


--
-- TOC entry 3144 (class 2606 OID 53266)
-- Name: cultivos cultivos_cod_lot_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultivos
    ADD CONSTRAINT cultivos_cod_lot_fkey FOREIGN KEY (cod_lot) REFERENCES public.lotes(cod_lot);


--
-- TOC entry 3145 (class 2606 OID 53271)
-- Name: cultivos cultivos_cod_ncu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultivos
    ADD CONSTRAINT cultivos_cod_ncu_fkey FOREIGN KEY (cod_ncu) REFERENCES public.nombre_cultivo(cod_ncu);


--
-- TOC entry 3146 (class 2606 OID 53276)
-- Name: cultural cultural_cod_tar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cultural
    ADD CONSTRAINT cultural_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);


--
-- TOC entry 3149 (class 2606 OID 53281)
-- Name: dueño dueño_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."dueño"
    ADD CONSTRAINT "dueño_ide_ter_fkey" FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3152 (class 2606 OID 53286)
-- Name: ejecutar ejecutar_cod_con_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ejecutar
    ADD CONSTRAINT ejecutar_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);


--
-- TOC entry 3153 (class 2606 OID 53291)
-- Name: ejecutar ejecutar_cod_cul_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ejecutar
    ADD CONSTRAINT ejecutar_cod_cul_fkey FOREIGN KEY (cod_cul) REFERENCES public.cultivos(cod_cul);


--
-- TOC entry 3154 (class 2606 OID 53296)
-- Name: email_tercero email_tercero_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_tercero
    ADD CONSTRAINT email_tercero_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3158 (class 2606 OID 53301)
-- Name: fincas fincas_cod_dep_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_cod_dep_fkey FOREIGN KEY (cod_dep) REFERENCES public.departamento(cod_dep);


--
-- TOC entry 3159 (class 2606 OID 53306)
-- Name: fincas fincas_cod_mun_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_cod_mun_fkey FOREIGN KEY (cod_mun) REFERENCES public.municipio(cod_mun);


--
-- TOC entry 3160 (class 2606 OID 53311)
-- Name: fincas fincas_cod_unm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);


--
-- TOC entry 3161 (class 2606 OID 53316)
-- Name: fincas fincas_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fincas
    ADD CONSTRAINT fincas_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3162 (class 2606 OID 53321)
-- Name: fitosanitaria fitosanitaria_cod_tar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fitosanitaria
    ADD CONSTRAINT fitosanitaria_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);


--
-- TOC entry 3156 (class 2606 OID 53326)
-- Name: eta_x_afe fk_afe_x_eta_x_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eta_x_afe
    ADD CONSTRAINT fk_afe_x_eta_x_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);


--
-- TOC entry 3169 (class 2606 OID 53331)
-- Name: mol_x_afe fk_afe_x_mol_x_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT fk_afe_x_mol_x_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);


--
-- TOC entry 3134 (class 2606 OID 53336)
-- Name: agr_x_mol fk_agr_x_agr_mol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agr_x_mol
    ADD CONSTRAINT fk_agr_x_agr_mol FOREIGN KEY (cod_agr) REFERENCES public.agroquimicos(cod_agr);


--
-- TOC entry 3132 (class 2606 OID 53341)
-- Name: agr_x_eag fk_agr_x_agr_x_eag; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agr_x_eag
    ADD CONSTRAINT fk_agr_x_agr_x_eag FOREIGN KEY (cod_agr) REFERENCES public.agroquimicos(cod_agr);


--
-- TOC entry 3133 (class 2606 OID 53346)
-- Name: agr_x_eag fk_eag_x_agr_x_eag; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agr_x_eag
    ADD CONSTRAINT fk_eag_x_agr_x_eag FOREIGN KEY (cod_eag) REFERENCES public.estado_agroquimico(cod_eag);


--
-- TOC entry 3155 (class 2606 OID 53351)
-- Name: enfermedades fk_enf_x_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enfermedades
    ADD CONSTRAINT fk_enf_x_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);


--
-- TOC entry 3157 (class 2606 OID 53356)
-- Name: eta_x_afe fk_eta_x_eta_x_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eta_x_afe
    ADD CONSTRAINT fk_eta_x_eta_x_afe FOREIGN KEY (cod_eta) REFERENCES public.etapas_crecimiento(cod_eta);


--
-- TOC entry 3170 (class 2606 OID 53361)
-- Name: mol_x_afe fk_eta_x_mol_x_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT fk_eta_x_mol_x_afe FOREIGN KEY (cod_eta) REFERENCES public.etapas_crecimiento(cod_eta);


--
-- TOC entry 3135 (class 2606 OID 53366)
-- Name: agr_x_mol fk_mol_x_agr_mol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agr_x_mol
    ADD CONSTRAINT fk_mol_x_agr_mol FOREIGN KEY (cod_mol) REFERENCES public.moleculas(cod_mol);


--
-- TOC entry 3171 (class 2606 OID 53371)
-- Name: mol_x_afe fk_mol_x_mol_x_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mol_x_afe
    ADD CONSTRAINT fk_mol_x_mol_x_afe FOREIGN KEY (cod_mol) REFERENCES public.moleculas(cod_mol);


--
-- TOC entry 3174 (class 2606 OID 53376)
-- Name: plagas fk_plg_afe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plagas
    ADD CONSTRAINT fk_plg_afe FOREIGN KEY (cod_afe) REFERENCES public.afeccion(cod_afe);


--
-- TOC entry 3137 (class 2606 OID 53381)
-- Name: agroquimicos fk_tag_x_agr; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT fk_tag_x_agr FOREIGN KEY (cod_tag) REFERENCES public.tipo_agroquimico(cod_tag);


--
-- TOC entry 3138 (class 2606 OID 53386)
-- Name: agroquimicos fk_tox_x_agr; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agroquimicos
    ADD CONSTRAINT fk_tox_x_agr FOREIGN KEY (cod_tox) REFERENCES public.toxicidad(cod_tox);


--
-- TOC entry 3163 (class 2606 OID 53391)
-- Name: gozar gozar_cod_pro_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gozar
    ADD CONSTRAINT gozar_cod_pro_fkey FOREIGN KEY (cod_pro) REFERENCES public.produccion(cod_pro);


--
-- TOC entry 3164 (class 2606 OID 53396)
-- Name: gozar gozar_cod_tpr_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gozar
    ADD CONSTRAINT gozar_cod_tpr_fkey FOREIGN KEY (cod_tpr) REFERENCES public.tipo_de_produccion(cod_tpr);


--
-- TOC entry 3165 (class 2606 OID 53401)
-- Name: insumos insumos_cod_unm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.insumos
    ADD CONSTRAINT insumos_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);


--
-- TOC entry 3166 (class 2606 OID 53406)
-- Name: jornales jornales_cod_con_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jornales
    ADD CONSTRAINT jornales_cod_con_fkey FOREIGN KEY (cod_con) REFERENCES public.convenio(cod_con);


--
-- TOC entry 3147 (class 2606 OID 53411)
-- Name: desarrollar labores_cod_lab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.desarrollar
    ADD CONSTRAINT labores_cod_lab_fkey FOREIGN KEY (cod_lab) REFERENCES public.labores(cod_lab);


--
-- TOC entry 3167 (class 2606 OID 53416)
-- Name: lotes lotes_cod_fin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_cod_fin_fkey FOREIGN KEY (cod_fin) REFERENCES public.fincas(cod_fin);


--
-- TOC entry 3168 (class 2606 OID 53421)
-- Name: lotes lotes_cod_unm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);


--
-- TOC entry 3172 (class 2606 OID 53426)
-- Name: municipio municipio_cod_dep_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT municipio_cod_dep_fkey FOREIGN KEY (cod_dep) REFERENCES public.departamento(cod_dep);


--
-- TOC entry 3173 (class 2606 OID 53431)
-- Name: otros otros_cod_ins_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otros
    ADD CONSTRAINT otros_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);


--
-- TOC entry 3175 (class 2606 OID 53436)
-- Name: pre_sto pre_sto_cod_sto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pre_sto
    ADD CONSTRAINT pre_sto_cod_sto_fkey FOREIGN KEY (cod_sto) REFERENCES public.stock(cod_sto);


--
-- TOC entry 3176 (class 2606 OID 53441)
-- Name: produccion produccion_cod_cul_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produccion
    ADD CONSTRAINT produccion_cod_cul_fkey FOREIGN KEY (cod_cul) REFERENCES public.cultivos(cod_cul);


--
-- TOC entry 3177 (class 2606 OID 53446)
-- Name: produccion produccion_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produccion
    ADD CONSTRAINT produccion_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3178 (class 2606 OID 53451)
-- Name: proveedor proveedor_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3179 (class 2606 OID 53456)
-- Name: registrar registar_cod_com_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registrar
    ADD CONSTRAINT registar_cod_com_fkey FOREIGN KEY (cod_com) REFERENCES public.compras(cod_com);


--
-- TOC entry 3180 (class 2606 OID 53461)
-- Name: registrar registar_cod_sto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registrar
    ADD CONSTRAINT registar_cod_sto_fkey FOREIGN KEY (cod_sto) REFERENCES public.stock(cod_sto);


--
-- TOC entry 3181 (class 2606 OID 53466)
-- Name: semillas semillas_cod_ins_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillas
    ADD CONSTRAINT semillas_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);


--
-- TOC entry 3182 (class 2606 OID 53471)
-- Name: semillas semillas_cod_tsa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillas
    ADD CONSTRAINT semillas_cod_tsa_fkey FOREIGN KEY (cod_tsa) REFERENCES public.tipo_semilla(cod_tsa);


--
-- TOC entry 3183 (class 2606 OID 53476)
-- Name: semillero semillero_cod_ins_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillero
    ADD CONSTRAINT semillero_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);


--
-- TOC entry 3184 (class 2606 OID 53481)
-- Name: semillero semillero_cod_tso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semillero
    ADD CONSTRAINT semillero_cod_tso_fkey FOREIGN KEY (cod_tso) REFERENCES public.tipo_semillero(cod_tso);


--
-- TOC entry 3185 (class 2606 OID 53486)
-- Name: socio socio_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.socio
    ADD CONSTRAINT socio_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3186 (class 2606 OID 53491)
-- Name: stock stock_cod_ins_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stock
    ADD CONSTRAINT stock_cod_ins_fkey FOREIGN KEY (cod_ins) REFERENCES public.insumos(cod_ins);


--
-- TOC entry 3148 (class 2606 OID 53496)
-- Name: desarrollar tarea_cod_tar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.desarrollar
    ADD CONSTRAINT tarea_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);


--
-- TOC entry 3151 (class 2606 OID 53501)
-- Name: efectuar tarea_cod_tar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.efectuar
    ADD CONSTRAINT tarea_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);


--
-- TOC entry 3187 (class 2606 OID 53506)
-- Name: tel_tercero tel_tercero_ide_ter_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tel_tercero
    ADD CONSTRAINT tel_tercero_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


--
-- TOC entry 3188 (class 2606 OID 53511)
-- Name: tipo_de_produccion tipo_de_produccion_cod_unm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_de_produccion
    ADD CONSTRAINT tipo_de_produccion_cod_unm_fkey FOREIGN KEY (cod_unm) REFERENCES public.unidad_de_medida(cod_unm);




ALTER TABLE ONLY public.trabajador
    ADD CONSTRAINT trabajador_ide_ter_fkey FOREIGN KEY (ide_ter) REFERENCES public.terceros(ide_ter);


ALTER TABLE ONLY public.unidad_de_medida
    ADD CONSTRAINT unidad_de_medida_cod_tum_fkey FOREIGN KEY (cod_tum) REFERENCES public.tipo_unidad_medida(cod_tum);


ALTER TABLE ONLY public.utilizar
    ADD CONSTRAINT utilizar_cod_sto_fkey FOREIGN KEY (cod_sto) REFERENCES public.stock(cod_sto);


ALTER TABLE ONLY public.utilizar
    ADD CONSTRAINT utilizar_cod_tar_fkey FOREIGN KEY (cod_tar) REFERENCES public.tarea(cod_tar);



