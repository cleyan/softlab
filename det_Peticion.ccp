<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="903" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lblRutaDetalle" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="905" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="fun_muestrarecibo" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<IncludePage id="930" hasOperation="True" name="detalle_peticion" wizardTheme="InLine" wizardThemeType="File" page="detalle_peticion.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<EditableGrid id="732" urlType="Relative" secured="True" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" dataSource="estados, peticiones_detalle, test" name="grdDetalles" wizardCaption="Lista de Estados, Peticiones Detalle, Test, Secciones " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="UConditions" activeTableType="customUpdate" customUpdateType="Table" customUpdate="peticiones_detalle" orderBy="test_main_id, decompuesto desc, cod_test" PathID="grdDetalles">
			<Components>
				<Link id="861" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnk_detalles" wizardTheme="Inline" wizardThemeType="File" html="True" visible="Yes" PathID="grdDetalleslnk_detalles">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="977"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="860" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_class" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="789" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_info" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="863" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="detalle_compuesto" wizardTheme="Inline" wizardThemeType="File" hrefSource="det_Peticion.ccp" visible="Yes" PathID="grdDetallesdetalle_compuesto">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="864" sourceType="DataField" name="test_main_id" source="test_main_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="781" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="muestra_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="774" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cod_test" fieldSource="cod_test" required="False" caption="Cod Test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="790" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_hidden" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="775" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="precio" fieldSource="precio" caption="Precio del Test" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="grdDetallesprecio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="776" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prioridad_id" fieldSource="prioridad_id" caption="Prioridad para el Test" wizardCaption="Prioridad Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="prioridades" boundColumn="prioridad_id" textColumn="nom_prioridad" required="True" visible="Yes" PathID="grdDetallesprioridad_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Hidden id="788" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="decompuesto" wizardTheme="Inline" wizardThemeType="File" fieldSource="decompuesto" PathID="grdDetallesdecompuesto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="777" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_estado" fieldSource="nom_estado" required="False" caption="Nom Estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="779" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="grdDetallesButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="780" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ImageLink id="838" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkNueva" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_peticion.ccp" visible="Yes" PathID="grdDetalleslnkNueva">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="839" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkEditar" wizardTheme="Inline" wizardThemeType="File" hrefSource="edit_peticion.ccp" visible="Yes" PathID="grdDetalleslnkEditar">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="840" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="841" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkAbonos" wizardTheme="Inline" wizardThemeType="File" hrefSource="list_pago_peticion.ccp" visible="Yes" PathID="grdDetalleslnkAbonos">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="842" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="843" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkRecibo" wizardTheme="Inline" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="grdDetalleslnkRecibo">
					<Components/>
					<Events/>
					<LinkParameters>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="902" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="grdDetallesImageLink1">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="847" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkTomaMuestra" wizardTheme="Inline" wizardThemeType="File" hrefSource="ver_tomademuestra.ccp" visible="Yes" PathID="grdDetalleslnkTomaMuestra">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="848" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="931" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink2" wizardTheme="Inline" wizardThemeType="File" hrefSource="del_peticion.ccp" visible="Yes" PathID="grdDetallesImageLink2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="933" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="934" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink4" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="grdDetallesImageLink4">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="932" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkPendientes" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="grdDetalleslnkPendientes">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="853" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkResultados" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_resultados_peticion2.ccp" visible="Yes" PathID="grdDetalleslnkResultados">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="854" sourceType="URL" name="s_peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="855" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="lnkValidar" wizardTheme="Inline" wizardThemeType="File" hrefSource="validar_resultados_peticion.ccp" visible="Yes" PathID="grdDetalleslnkValidar">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="856" sourceType="URL" name="s_peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="978" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="lnkInformes" wizardTheme="Inline" wizardThemeType="File" hrefSource="list_informes.ccp" visible="Yes" PathID="grdDetalleslnkInformes">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="979" sourceType="URL" name="peticion_id" source="s_peticion_id"/>
						<LinkParameter id="980" sourceType="URL" name="s_peticion_id" source="s_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="787"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="782" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" orderNumber="1" parameterSource="peticion_id"/>
				<TableParameter id="836" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.decompuesto" dataType="Text" searchConditionType="NotEqual" parameterType="URL" logicOperator="Or" parameterSource="condetalle" orderNumber="2" defaultValue="'V'" leftBrackets="1"/>
				<TableParameter id="865" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.test_main_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="test_main_id" orderNumber="3" rightBrackets="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="887" tableName="estados" posWidth="129" posHeight="179" posLeft="10" posTop="10"/>
				<JoinTable id="890" tableName="peticiones_detalle" posWidth="140" posHeight="275" posLeft="180" posTop="9"/>
				<JoinTable id="893" tableName="test" posWidth="174" posHeight="477" posLeft="359" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="897" fieldLeft="peticiones_detalle.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones_detalle" tableRight="estados" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="898" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="889" tableName="estados" fieldName="nom_estado"/>
				<Field id="891" tableName="peticiones_detalle" fieldName="peticiones_detalle.*"/>
				<Field id="895" tableName="test" fieldName="cod_test"/>
				<Field id="896" tableName="test" fieldName="nom_test"/>
			</Fields>
			<PKFields>
				<PKField id="982" tableName="estados" fieldName="estado_id" dataType="Integer"/>
				<PKField id="983" tableName="peticiones_detalle" fieldName="detalle_peticion_id" dataType="Integer"/>
				<PKField id="984" tableName="test" fieldName="test_id" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="783" conditionType="Parameter" useIsNull="False" field="detalle_peticion_id" dataType="Integer" parameterType="DataSourceColumn" defaultValue="0" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="detalle_peticion_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="784" field="precio" dataType="Integer" parameterType="Control" parameterSource="precio"/>
				<CustomParameter id="785" field="prioridad_id" dataType="Integer" parameterType="Control" parameterSource="prioridad_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups>
				<Group id="964" groupID="4" read="True" insert="True" update="True" delete="True"/>
				<Group id="965" groupID="5" read="True" insert="True" update="True" delete="True"/>
				<Group id="966" groupID="8" read="True" insert="True" update="True" delete="True"/>
				<Group id="967" groupID="11" read="True" insert="True" update="True" delete="True"/>
				<Group id="968" groupID="12" read="True" insert="True" update="True" delete="True"/>
				<Group id="969" groupID="13" read="True" insert="True" update="True" delete="True"/>
				<Group id="970" groupID="14" read="True" insert="True" update="True" delete="True"/>
				<Group id="971" groupID="15" read="True" insert="True" update="True" delete="True"/>
				<Group id="972" groupID="16" read="True" insert="True" update="True" delete="True"/>
				<Group id="973" groupID="17" read="True" insert="True" update="True" delete="True"/>
				<Group id="974" groupID="18" read="True" insert="True" update="True" delete="True"/>
				<Group id="975" groupID="19" read="True" insert="True" update="True" delete="True"/>
				<Group id="976" groupID="20" read="True" insert="True" update="True" delete="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
		</EditableGrid>
		<Grid id="909" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="DetBitacora" dataSource="bitacora, tipos_bitacora, usuarios, estados" pageSizeLimit="100" wizardCaption="Lista de Bitacora, Tipos Bitacora, Usuarios, Estados " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="DetBitacora">
			<Components>
				<Sorter id="921" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="DetBitacoraSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="922" visible="True" name="Tipo" column="nom_tipo_bitacora" wizardCaption="Nom Tipo Bitacora" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_tipo_bitacora" PathID="DetBitacoraTipo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="923" visible="True" name="Sorter_nom_estado" column="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado" PathID="DetBitacoraSorter_nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="924" visible="True" name="Sorter_nom_usuario" column="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_usuario" PathID="DetBitacoraSorter_nom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="942" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="lnkAccion" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="DetBitacoralnkAccion">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="945"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="943" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="estado_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="estado_id" PathID="DetBitacoraestado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="944" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="bitacora_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="bitacora_id" PathID="DetBitacorabitacora_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="946" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="tipo_bitacora_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="tipo_bitacora_id" PathID="DetBitacoratipo_bitacora_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="925" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd-mm-yyyy h:nn AM/PM" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="926" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="927" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_tipo_bitacora" fieldSource="nom_tipo_bitacora" wizardCaption="Nom Tipo Bitacora" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="928" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="929" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="935" conditionType="Parameter" useIsNull="False" field="bitacora.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="peticion_id" orderNumber="1"/>
				<TableParameter id="940" conditionType="Parameter" useIsNull="False" field="bitacora.nivel_id" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" defaultValue="0" parameterSource="CCGetGroupID()" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="910" tableName="bitacora" posWidth="173" posHeight="216" posLeft="10" posTop="10"/>
				<JoinTable id="912" tableName="tipos_bitacora" posWidth="100" posHeight="100" posLeft="265" posTop="6"/>
				<JoinTable id="914" tableName="usuarios" posWidth="100" posHeight="100" posLeft="385" posTop="37"/>
				<JoinTable id="916" tableName="estados" posWidth="100" posHeight="100" posLeft="392" posTop="122"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="918" fieldLeft="bitacora.tipo_bitacora_id" fieldRight="tipos_bitacora.tipo_bitacora_id" tableLeft="bitacora" tableRight="tipos_bitacora" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="919" fieldLeft="bitacora.usuario_id" fieldRight="usuarios.usuario_id" tableLeft="bitacora" tableRight="usuarios" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="920" fieldLeft="bitacora.estado_id" fieldRight="estados.estado_id" tableLeft="bitacora" tableRight="estados" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="911" tableName="bitacora" fieldName="bitacora.*"/>
				<Field id="913" tableName="tipos_bitacora" fieldName="nom_tipo_bitacora"/>
				<Field id="915" tableName="usuarios" fieldName="nom_usuario"/>
				<Field id="917" tableName="estados" fieldName="nom_estado"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="det_Peticion.php" comment="//" codePage="utf-8" forShow="True" url="det_Peticion.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="det_Peticion_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="947" groupID="4"/>
		<Group id="948" groupID="5"/>
		<Group id="949" groupID="6"/>
		<Group id="950" groupID="7"/>
		<Group id="951" groupID="8"/>
		<Group id="952" groupID="9"/>
		<Group id="953" groupID="10"/>
		<Group id="954" groupID="11"/>
		<Group id="955" groupID="12"/>
		<Group id="956" groupID="13"/>
		<Group id="957" groupID="14"/>
		<Group id="958" groupID="15"/>
		<Group id="959" groupID="16"/>
		<Group id="960" groupID="17"/>
		<Group id="961" groupID="18"/>
		<Group id="962" groupID="19"/>
		<Group id="963" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="904"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="981"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
