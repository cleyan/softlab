<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="informesSearch" wizardCaption="Buscar Informes " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="def_informe.ccp" PathID="informesSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nom_informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="informesSearchs_nom_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="informesSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="informes" connection="Datos" dataSource="informes" wizardCaption="Lista de Informes " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardRecordSeparator="False" orderBy="nom_informe" PathID="informes">
			<Components>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="informes_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="8"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="10" visible="True" name="Sorter_nom_informe" column="nom_informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_informe" PathID="informesSorter_nom_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="45" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="icon_plus" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_informe.ccp" removeParameters="detalle_informe_id;limpiar" html="True" visible="Yes" PathID="informesicon_plus">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="48" sourceType="DataField" name="detalle_informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<ImageLink id="39" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Editar" wizardTheme="Inline" wizardThemeType="File" defaultValue="'[Editar]'" hrefSource="def_informe.ccp" visible="Yes" PathID="informesEditar">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="41" sourceType="DataField" name="informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="nom_informe" fieldSource="nom_informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefSource="def_informe.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="14" sourceType="DataField" name="informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="50" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="informe_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="informe_id" PathID="informesinforme_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="linea" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="35" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="detalle" wizardTheme="Inline" wizardThemeType="File" defaultValue="Detalles" hrefSource="def_informe_detalle.ccp" removeParameters="informe_id" visible="Yes" PathID="informesdetalle">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="36" sourceType="DataField" name="informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_lin_fondo" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_tree_1" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="57" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="det_grupo" wizardTheme="Inline" wizardThemeType="File" hrefSource="def_grupos.ccp" visible="Yes" PathID="informesdet_grupo">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="58" sourceType="DataField" name="s_informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lbl_det_grupo" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="6" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="informes_Insert" hrefSource="def_informe.ccp" removeParameters="informe_id" wizardTheme="Inline" wizardThemeType="File" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" wizardUseTemplateBlock="False" visible="Yes" PathID="informesinformes_Insert">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="62" sourceType="Expression" name="accion" source="&quot;agregar&quot;"/>
						<LinkParameter id="63" sourceType="Expression" name="informe_id" source="&quot;&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="61" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="menu_principal.ccp" visible="Yes" PathID="informesImageLink1">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="49"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Declare Variable" actionCategory="General" id="55" name="r" type="Integer" initialValue="1"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="nom_informe" parameterSource="s_nom_informe" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="24" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="informes1" dataSource="informes" errorSummator="Error" wizardCaption="Agregar/Editar Informes " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="def_informe.ccp" PathID="informes1">
			<Components>
				<TextBox id="31" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_informe" fieldSource="nom_informe" caption="Nom Informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="informes1nom_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="encabezado" wizardTheme="Inline" wizardThemeType="File" fieldSource="encabezado" visible="Yes" PathID="informes1encabezado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="44" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="pie" wizardTheme="Inline" wizardThemeType="File" fieldSource="pie" caption="Pie" visible="Yes" PathID="informes1pie">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="60" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="informes_encabezado_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" fieldSource="informes_encabezado_id" connection="Datos" dataSource="informes_encabezado" boundColumn="informes_encabezado_id" textColumn="nom_informes_encabezado" required="True" caption="Diseño del Encabezado de columna" visible="Yes" PathID="informes1informes_encabezado_id">
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
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="informes1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Enviar" PathID="informes1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="27" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="informes1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="28" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="29" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="def_informe.ccp" removeParameters="informe_id;accion" PathID="informes1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="59"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="64"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="informe_id" parameterSource="informe_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="def_informe_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="def_informe.php" comment="//" codePage="utf-8" forShow="True" url="def_informe.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="65" groupID="15"/>
		<Group id="66" groupID="16"/>
		<Group id="67" groupID="17"/>
		<Group id="68" groupID="18"/>
		<Group id="69" groupID="19"/>
		<Group id="70" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="71"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
