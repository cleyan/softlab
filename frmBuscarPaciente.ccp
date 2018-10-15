<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="fn_eligeAuto" wizardTheme="InLine" wizardThemeType="File">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="pacientesSearch" wizardCaption="Buscar Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="frmBuscarPaciente.ccp" PathID="pacientesSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_rut_ficha" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" visible="Yes" PathID="pacientesSearchs_rut_ficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nombre" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="pacientesSearchs_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="56" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_apellido" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="pacientesSearchs_apellido">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="pacientesSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="15" connection="Datos" name="pacientes" dataSource="pacientes" pageSizeLimit="100" wizardCaption="Lista de Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" wizardUsePageScroller="True" parameterTypeListName="ParameterTypeList" PathID="pacientes">
			<Components>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="pacientes_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="10"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="15" visible="True" name="Sorter_rut" column="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="rut" PathID="pacientesSorter_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_ficha" column="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="ficha" PathID="pacientesSorter_ficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="17" visible="True" name="Sorter_nombres" column="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nombres" PathID="pacientesSorter_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="18" visible="True" name="Sorter_apellidos" column="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="apellidos" PathID="pacientesSorter_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="Aceptar" wizardTheme="Inline" wizardThemeType="File">
					<Components/>

					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="paciente_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="paciente_id" PathID="pacientespaciente_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="prevision_id" PathID="pacientesprevision_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="win_add_paciente.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="42" sourceType="Expression" name="origen" source="&quot;desdeventana&quot;"/>
						<LinkParameter id="46" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="win_add_paciente.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="43" sourceType="Expression" name="origen" source="&quot;desdeventana&quot;"/>
						<LinkParameter id="47" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="50" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="Inline" wizardThemeType="File" hrefSource="win_add_paciente.ccp" visible="Yes" PathID="pacientesImageLink2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="52" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="Alt_Aceptar" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="Alt_paciente_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="paciente_id" PathID="pacientesAlt_paciente_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="Alt_prevision_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="prevision_id" PathID="pacientesAlt_prevision_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="win_add_paciente.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="44" sourceType="Expression" name="origen" source="&quot;desdeventana&quot;"/>
						<LinkParameter id="48" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="win_add_paciente.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="45" sourceType="Expression" name="origen" source="&quot;desdeventana&quot;"/>
						<LinkParameter id="49" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="51" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink3" wizardTheme="Inline" wizardThemeType="File" hrefSource="win_add_paciente.ccp" visible="Yes" PathID="pacientesImageLink3">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="53" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Navigator id="35" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="pacientesNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<ImageLink id="37" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="btn_agregar" wizardTheme="Inline" wizardThemeType="File" hrefSource="win_add_paciente.ccp" visible="Yes" PathID="pacientesbtn_agregar">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="39" sourceType="Expression" name="origen" source="&quot;desdeventana&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="38" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="pacientesImageLink1">
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
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="rut" parameterSource="s_rut_ficha" dataType="Text" logicOperator="Or" searchConditionType="BeginsWith" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="ficha" parameterSource="s_rut_ficha" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1"/>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombre" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" leftBrackets="1"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellido" dataType="Text" logicOperator="And" searchConditionType="BeginsWith" parameterType="URL" orderNumber="4" rightBrackets="1"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="54" variable="s_rut_ficha" parameterType="URL" dataType="Text" parameterSource="s_rut_ficha"/>
				<SQLParameter id="55" variable="s_nombre" parameterType="URL" dataType="Text" parameterSource="s_nombre"/>
				<SQLParameter id="57" variable="s_apellido" parameterType="URL" dataType="Text" parameterSource="s_apellido"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="frmBuscarPaciente_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="frmBuscarPaciente.php" comment="//" codePage="utf-8" forShow="True" url="frmBuscarPaciente.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="40"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="58"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
