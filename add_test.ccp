<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_test_id" wizardTheme="InLine" wizardThemeType="File" defaultValue="CCGetParam(&quot;test_id&quot;,&quot;&quot;)">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="test" dataSource="test" errorSummator="Error" wizardCaption="Agregar/Editar Test " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="list_test.ccp" PathID="test">
			<Components>
				<TextBox id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="codigo_fonasa" fieldSource="codigo_fonasa" required="False" caption="Código Fonasa" wizardCaption="Codigo Fonasa" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testcodigo_fonasa">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="84" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="sub_codigo" wizardTheme="Inline" wizardThemeType="File" fieldSource="sub_codigo" visible="Yes" PathID="testsub_codigo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cod_test" fieldSource="cod_test" caption="Código del Test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="testcod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_test" fieldSource="nom_test" caption="Nombre del Test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="False" visible="Yes" PathID="testnom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="unidad_medida" fieldSource="unidad_medida" required="False" caption="Unidad Medida" wizardCaption="Unidad Medida" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testunidad_medida">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="secciones_id" fieldSource="secciones_id" caption="Sección" wizardCaption="Secciones Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" required="True" orderBy="orden" activeCollection="TableParameters" activeTableType="dataSource" visible="Yes" PathID="testsecciones_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="indicacion_id" fieldSource="indicacion_id" caption="Indicación" wizardCaption="Indicacion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="indicaciones_test" boundColumn="indicacion_test_id" textColumn="nom_indicacion" unique="False" required="True" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_indicacion" visible="Yes" PathID="testindicacion_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="53" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="metodo_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" fieldSource="metodo_id" connection="Datos" dataSource="metodos" boundColumn="metodo_id" textColumn="nom_metodo" required="True" caption="Método" orderBy="nom_metodo" visible="Yes" PathID="testmetodo_id">
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
				<ListBox id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="equipo_id" fieldSource="equipo_id" caption="Equipo" wizardCaption="Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" required="True" orderBy="nom_equipo" activeCollection="TableParameters" activeTableType="dataSource" visible="Yes" PathID="testequipo_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="55" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="12" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="tipo_muestra_id" fieldSource="tipo_muestra_id" caption="Tipo de Muestra" wizardCaption="Tipo Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="tipos_muestra" boundColumn="tipo_muestra_id" textColumn="nom_tipo_muestra" unique="False" required="True" orderBy="nom_tipo_muestra" activeCollection="TableParameters" activeTableType="dataSource" visible="Yes" PathID="testtipo_muestra_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="31" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="informe_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" fieldSource="informe_id" connection="Datos" dataSource="informes" boundColumn="informe_id" textColumn="nom_informe" orderBy="nom_informe" required="True" caption="Informe predeterminado" visible="Yes" PathID="testinforme_id">
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
				<CheckBox id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="aislado" fieldSource="aislado" required="False" caption="Aislado" wizardCaption="Aislado" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" defaultValue="'V'" visible="Yes" PathID="testaislado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="22" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="compuesto" fieldSource="compuesto" required="False" caption="Compuesto" wizardCaption="Compuesto" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="testcompuesto" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="resopcional" fieldSource="opcional" required="False" caption="Acceso Rapido" wizardCaption="Acceso Rapido" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="testresopcional" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="26" fieldSourceType="DBColumn" dataType="Boolean" html="False" editable="True" hasErrorCollection="True" name="contextarea" fieldSource="con_text_area" required="False" caption="Con Text Area" wizardCaption="Con Text Area" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="testcontextarea" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="conarchivo" fieldSource="con_archivo" required="False" caption="Con Archivo" wizardCaption="Con Archivo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="testconarchivo" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="conmultipleresultado" fieldSource="con_multiple_resultado" required="False" caption="Con Multiple Resultado" wizardCaption="Con Multiple Resultado" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="testconmultipleresultado" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="35" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="formula" wizardTheme="Inline" wizardThemeType="File" fieldSource="formula" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="testformula" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Link id="40" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="edit_formula" wizardTheme="Inline" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="testedit_formula">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="41"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<TextBox id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="dias_demora" wizardTheme="Inline" wizardThemeType="File" fieldSource="dias_demora" defaultValue="0" visible="Yes" PathID="testdias_demora">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="orden_peticion" fieldSource="orden_peticion" caption="Orden Peticion" wizardCaption="Orden Peticion" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="0" required="True" visible="Yes" PathID="testorden_peticion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ImageLink id="42" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ver_orden_pet" wizardTheme="Inline" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="testver_orden_pet">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<TextBox id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="orden_informe" fieldSource="orden_informe" caption="Orden Informe" wizardCaption="Orden Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="0" required="True" visible="Yes" PathID="testorden_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ImageLink id="43" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ver_orden_inf" wizardTheme="Inline" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="testver_orden_inf">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<TextBox id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="orden_ingreso" wizardTheme="Inline" wizardThemeType="File" fieldSource="orden_ingreso" caption="Orden en Venta de ingreso de Resultados" required="True" defaultValue="0" visible="Yes" PathID="testorden_ingreso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="anotaciones" fieldSource="anotaciones" required="False" caption="Anotaciones" wizardCaption="Anotaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="testanotaciones">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="17" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="True" hasErrorCollection="True" name="observaciones" fieldSource="observaciones" required="False" caption="Observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" visible="Yes" PathID="testobservaciones">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="58" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="plantilla_ht" wizardTheme="Inline" wizardThemeType="File" fieldSource="plantilla_ht" visible="Yes" PathID="testplantilla_ht">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<ListBox id="95" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="grupo_modelo_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" fieldSource="grupo_modelo_id" connection="Datos" dataSource="grupos_modelo" boundColumn="grupo_modelo_id" textColumn="nom_grupo_modelo" visible="Yes" PathID="testgrupo_modelo_id">
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
				<CheckBox id="99" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="imprime_etq" wizardTheme="Inline" wizardThemeType="File" fieldSource="imprime_etq" checkedValue="'V'" uncheckedValue="'F'" defaultValue="'V'" PathID="testimprime_etq">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<CheckBox id="100" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="imprime_ot" wizardTheme="Inline" wizardThemeType="File" fieldSource="imprime_ot" checkedValue="'V'" uncheckedValue="'F'" defaultValue="'V'" PathID="testimprime_ot">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Label id="77" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_iframe_valores" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="78"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="75" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_iframe_compuesto" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="76"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="82" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" wizardTheme="Inline" wizardThemeType="File" operation="Insert" PathID="testButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="79" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" wizardTheme="Inline" wizardThemeType="File" operation="Update" PathID="testButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="80" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" wizardTheme="Inline" wizardThemeType="File" operation="Delete" PathID="testButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="83" message="Está seguro de Eliminar este test? \n El proceso es irreversible"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="81" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" wizardTheme="Inline" wizardThemeType="File" operation="Cancel" PathID="testButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<CheckBox id="38" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="imprimible" wizardTheme="Inline" wizardThemeType="File" fieldSource="imprimible" checkedValue="'V'" uncheckedValue="'F'" defaultValue="'V'" visible="Yes" PathID="testimprimible">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="60"/>
					</Actions>
				</Event>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="97"/>
					</Actions>
				</Event>
				<Event name="AfterDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="98"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="test_id" parameterSource="test_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_test.php" comment="//" codePage="utf-8" forShow="True" url="add_test.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_test_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="85" groupID="5"/>
		<Group id="86" groupID="12"/>
		<Group id="87" groupID="13"/>
		<Group id="88" groupID="14"/>
		<Group id="89" groupID="15"/>
		<Group id="90" groupID="16"/>
		<Group id="91" groupID="17"/>
		<Group id="92" groupID="18"/>
		<Group id="93" groupID="19"/>
		<Group id="94" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="96"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
