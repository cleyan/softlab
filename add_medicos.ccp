<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="57" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="medicos" dataSource="medicos" errorSummator="Error" wizardCaption="Agregar/Editar Medicos " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="list_medicos.ccp" PathID="medicos">
			<Components>
				<TextBox id="64" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_medico" fieldSource="nom_medico" caption="Nom Medico" wizardCaption="Nom Medico" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" unique="True" visible="Yes" PathID="medicosnom_medico">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="65" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="especialidad_id" fieldSource="especialidad_id" required="False" caption="Especialidad Id" wizardCaption="Especialidad Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="especialidades" boundColumn="especialidad_id" textColumn="nom_especialidad" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_especialidad" visible="Yes" PathID="medicosespecialidad_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="70" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
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
				<TextBox id="66" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="fono" fieldSource="fono" required="False" caption="Fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="medicosfono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="67" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="email" fieldSource="email" required="False" caption="Email" wizardCaption="Email" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$" visible="Yes" PathID="medicosemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="68" fieldSourceType="DBColumn" dataType="Float" html="False" editable="True" hasErrorCollection="True" name="factor" fieldSource="factor" caption="Factor" wizardCaption="Factor" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" required="False" visible="Yes" PathID="medicosfactor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="69" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="activo" fieldSource="activo" required="False" caption="Activo" wizardCaption="Activo" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" checkedValue="'V'" uncheckedValue="'F'" visible="Yes" PathID="medicosactivo" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="58" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="medicosButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="59" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="medicosButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="60" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="medicosButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="61" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="62" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="medicosButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="63" conditionType="Parameter" useIsNull="False" field="medico_id" parameterSource="medico_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="add_medicos.php" comment="//" codePage="utf-8" forShow="True" url="add_medicos.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="add_medicos_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="71" groupID="17"/>
		<Group id="72" groupID="18"/>
		<Group id="73" groupID="19"/>
		<Group id="74" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="75"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
