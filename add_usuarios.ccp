<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="usuariosSearch" wizardCaption="Buscar Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="add_usuarios.ccp" PathID="usuariosSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="usuariosSearchs_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_nivel" wizardCaption="Nivel Acceso Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="niveles_acceso" boundColumn="nivel_acceso_id" textColumn="nom_nivel_acceso" activeCollection="TableParameters" activeTableType="dataSource" visible="Yes" PathID="usuariosSearchs_nivel">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="42" conditionType="Parameter" useIsNull="True" field="nivel_acceso_id" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="CCGetGroupID()" orderNumber="1"/>
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
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="usuariosSearchButton_DoSearch">
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
		<EditableGrid id="43" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="usuarios" connection="Datos" dataSource="usuarios" pageSizeLimit="100" wizardCaption="Lista de Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_usuario" PathID="usuarios">
			<Components>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="usuarios_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="46"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="48" visible="True" name="Sorter_nom_usuario" column="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_usuario" PathID="usuariosSorter_nom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="49" visible="True" name="Sorter_log_usuario" column="log_usuario" wizardCaption="Log Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="log_usuario" PathID="usuariosSorter_log_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="50" visible="True" name="Sorter_clave" column="clave" wizardCaption="Clave" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="clave" PathID="usuariosSorter_clave">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="47" visible="True" name="Sorter_procedencia_id" column="procedencia_id" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="procedencia_id" PathID="usuariosSorter_procedencia_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="52" visible="True" name="Sorter_seccion_id" column="seccion_id" wizardCaption="Seccion Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="seccion_id" PathID="usuariosSorter_seccion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<TextBox id="54" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_usuario" fieldSource="nom_usuario" caption="Nom Usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="usuariosnom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="55" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="log_usuario" fieldSource="log_usuario" caption="Log Usuario" wizardCaption="Log Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="usuarioslog_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="56" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="clave" fieldSource="clave" caption="Clave" wizardCaption="Clave" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="usuariosclave">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="57" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="nivel_acceso_id" fieldSource="nivel_acceso_id" caption="Nivel Acceso Id" wizardCaption="Nivel Acceso Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="niveles_acceso" boundColumn="nivel_acceso_id" textColumn="nom_nivel_acceso" activeCollection="TableParameters" activeTableType="dataSource" required="True" orderBy="nivel_acceso_id" visible="Yes" PathID="usuariosnivel_acceso_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="65" conditionType="Parameter" useIsNull="True" field="nivel_acceso_id" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="CCGetGroupID()" orderNumber="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="75" tableName="niveles_acceso" posLeft="10" posTop="10" posWidth="122" posHeight="104"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="procedencia_id" fieldSource="procedencia_id" required="False" caption="Procedencia Id" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" orderBy="nom_procedencia" visible="Yes" PathID="usuariosprocedencia_id">
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
				<ListBox id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="seccion_id" fieldSource="seccion_id" required="False" caption="Seccion Id" wizardCaption="Seccion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_seccion" visible="Yes" PathID="usuariosseccion_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="66" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" defaultValue="'V'" parameterSource="'V'" orderNumber="1"/>
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
				<CheckBox id="59" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="usuariosCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="60" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="usuariosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="61" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="usuariosButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="62" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="63" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="menu_principal.ccp" PathID="usuariosCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="67" conditionType="Parameter" useIsNull="False" field="log_usuario" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_usuario" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="68" conditionType="Parameter" useIsNull="False" field="nom_usuario" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_usuario" orderNumber="2" rightBrackets="1"/>
				<TableParameter id="69" conditionType="Parameter" useIsNull="True" field="nivel_acceso_id" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="CCGetGroupID()" orderNumber="3"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="76" tableName="usuarios" posLeft="10" posTop="10" posWidth="126" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="44" tableName="usuarios" fieldName="usuario_id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_usuarios.php" comment="//" codePage="utf-8" forShow="True" url="add_usuarios.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_usuarios_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="70" groupID="16"/>
		<Group id="71" groupID="17"/>
		<Group id="72" groupID="18"/>
		<Group id="73" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="74"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
