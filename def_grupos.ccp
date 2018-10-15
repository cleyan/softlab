<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="gruposSearch" wizardCaption="Buscar Grupos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="def_grupos.ccp" PathID="gruposSearch">
			<Components>
				<ListBox id="6" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_informe_id" wizardCaption="Informe Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="informes" boundColumn="informe_id" textColumn="nom_informe" orderBy="nom_informe" visible="Yes" PathID="gruposSearchs_informe_id">
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
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="gruposSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="grupos" connection="Datos" dataSource="grupos, grupos_modelo, informes" wizardCaption="Lista de Grupos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardRecordSeparator="False" orderBy="grupos.informe_id, orden, grupo_id" activeCollection="TableParameters" activeTableType="dataSource" PathID="grupos">
			<Components>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="grupos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="9"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="12" visible="True" name="Sorter_nom_grupo" column="nom_grupo" wizardCaption="Nom Grupo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_grupo" PathID="gruposSorter_nom_grupo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="36" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Link1" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_detalle_grupos.ccp" removeParameters="orden_informe_id;accion;orden_grupo_id" visible="Yes" PathID="gruposLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="38" sourceType="DataField" name="grupo_id" source="grupo_id"/>
						<LinkParameter id="40" sourceType="DataField" name="informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="15" fieldSourceType="DBColumn" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Detail" wizardCaption="Detail" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" dataType="Text" wizardDefaultValue="Detalles" hrefSource="def_grupos.ccp" removeParameters="orden_informe_id;accion;orden_grupo_id" visible="Yes" PathID="gruposDetail">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="16" sourceType="DataField" name="grupo_id" source="grupo_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_grupo" fieldSource="nom_grupo" wizardCaption="Nom Grupo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Boolean" html="False" editable="False" name="imprimir" wizardTheme="Inline" wizardThemeType="File" fieldSource="imprimir" format="Sí;No">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="76" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="alineacion" wizardTheme="Inline" wizardThemeType="File" fieldSource="alineacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_grupo_modelo" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_grupo_modelo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="orden" wizardTheme="Inline" wizardThemeType="File" fieldSource="orden">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="73" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="imgsube" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_grupos.ccp" removeParameters="orden_informe_id;accion;orden_grupo_id" html="True" visible="Yes" PathID="gruposimgsube">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="93" sourceType="DataField" name="orden_informe_id" source="informe_id"/>
						<LinkParameter id="94" sourceType="Expression" name="accion" source="&quot;subir&quot;"/>
						<LinkParameter id="99" sourceType="DataField" name="orden_grupo_id" source="grupo_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="74" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="img_baja" wizardTheme="Inline" wizardThemeType="File" removeParameters="orden_informe_id;accion;orden_grupo_id" hrefSource="def_grupos.ccp" html="True" visible="Yes" PathID="gruposimg_baja">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="95" sourceType="DataField" name="orden_informe_id" source="informe_id"/>
						<LinkParameter id="96" sourceType="Expression" name="accion" source="&quot;bajar&quot;"/>
						<LinkParameter id="98" sourceType="DataField" name="orden_grupo_id" source="grupo_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="7" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="grupos_Insert" hrefSource="def_grupos.ccp" removeParameters="grupo_id;orden_informe_id;accion;orden_grupo_id;nuevo" wizardTheme="Inline" wizardThemeType="File" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" wizardUseTemplateBlock="False" visible="Yes" PathID="gruposgrupos_Insert">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="105" sourceType="Expression" name="nuevo" source="&quot;si&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="107" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_informe.ccp" visible="Yes" PathID="gruposImageLink1">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="grupos.informe_id" parameterSource="s_informe_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2" defaultValue="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="85" tableName="grupos" posWidth="100" posHeight="227" posLeft="149" posTop="13"/>
				<JoinTable id="87" tableName="grupos_modelo" posWidth="100" posHeight="100" posLeft="276" posTop="15"/>
				<JoinTable id="89" tableName="informes" posWidth="109" posHeight="178" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="91" fieldLeft="grupos.alineacion" fieldRight="grupos_modelo.grupo_modelo_id" tableLeft="grupos" tableRight="grupos_modelo" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="92" fieldLeft="grupos.informe_id" fieldRight="informes.informe_id" tableLeft="grupos" tableRight="informes" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="86" tableName="grupos" fieldName="grupos.*"/>
				<Field id="88" tableName="grupos_modelo" fieldName="nom_grupo_modelo"/>
				<Field id="90" tableName="informes" fieldName="nom_informe"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="26" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="grupos1" dataSource="grupos" errorSummator="Error" wizardCaption="Agregar/Editar Grupos " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="def_grupos.ccp" removeParameters="grupo_id" PathID="grupos1">
			<Components>
				<ListBox id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="informe_id" fieldSource="informe_id" required="False" caption="Informe Id" wizardCaption="Informe Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="informes" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_informe" boundColumn="informe_id" textColumn="nom_informe" defaultValue="CCGetParam('s_informe_id','')" visible="Yes" PathID="grupos1informe_id">
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
				<TextBox id="33" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_grupo" fieldSource="nom_grupo" caption="Nom Grupo" wizardCaption="Nom Grupo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="grupos1nom_grupo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="55" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="imprimir" wizardTheme="Inline" wizardThemeType="File" checkedValue="'V'" uncheckedValue="'F'" fieldSource="imprimir" visible="Yes" PathID="grupos1imprimir" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<TextBox id="100" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="titulo" wizardTheme="Inline" wizardThemeType="File" fieldSource="titulo" required="False" visible="Yes" PathID="grupos1titulo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="42" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="alineacion" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" fieldSource="alineacion" connection="Datos" dataSource="grupos_modelo" boundColumn="grupo_modelo_id" textColumn="nom_grupo_modelo" required="True" orderBy="ORDEN" visible="Yes" PathID="grupos1alineacion">
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
				<RadioButton id="101" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" editable="True" returnValueType="Number" name="titulo_alineacion" wizardTheme="Inline" wizardThemeType="File" fieldSource="titulo_alineacion" _valueOfList="2" _nameOfList="Centrado" dataSource="0;Izquierda;1;Derecha;2;Centrado" required="True" visible="Yes" PathID="grupos1titulo_alineacion">
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
				</RadioButton>
				<CheckBox id="102" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="CheckBox1" wizardTheme="Inline" wizardThemeType="File" fieldSource="linea_bl_antes" visible="Yes" PathID="grupos1CheckBox1" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="103" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="CheckBox2" wizardTheme="Inline" wizardThemeType="File" fieldSource="linea_bl_despues" visible="Yes" PathID="grupos1CheckBox2" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<TextBox id="106" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="pie" wizardTheme="Inline" wizardThemeType="File" fieldSource="pie" required="False" visible="Yes" PathID="grupos1pie">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="orden" wizardTheme="Inline" wizardThemeType="File" fieldSource="orden" required="True" visible="Yes" PathID="grupos1orden">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="27" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="grupos1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="28" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="grupos1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="29" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="grupos1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="30" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="31" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="def_grupos.ccp" PathID="grupos1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="104"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="grupo_id" parameterSource="grupo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="56" tableName="grupos" posWidth="147" posHeight="211" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="57" tableName="grupos" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="def_grupos.php" comment="//" codePage="utf-8" forShow="True" url="def_grupos.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="def_grupos_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="108" groupID="15"/>
		<Group id="109" groupID="16"/>
		<Group id="110" groupID="17"/>
		<Group id="111" groupID="18"/>
		<Group id="112" groupID="19"/>
		<Group id="113" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="97"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="114"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
